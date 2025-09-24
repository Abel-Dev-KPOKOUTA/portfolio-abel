<?php namespace App\Controllers;

use App\Models\MessageModel;

class MessageController extends BaseController
{
    public function contact()
    {
        if ($this->request->getMethod() === 'post') {
            return $this->processContact();
        }
        
        $data = array_merge($this->getCommonData(), [
            'title' => 'Contact | Abel Kpokouta',
            'meta_description' => 'Contactez Abel Kpokouta pour discuter de projets, collaborations ou opportunités.'
        ]);
        
        return view('messages/contact', $data);
    }
    
    private function processContact()
    {
        $validation = $this->validate([
            'name'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email',
            'subject' => 'required|min_length[5]|max_length[200]',
            'message' => 'required|min_length[10]|max_length[2000]'
        ]);
        
        if (!$validation) {
            $data = array_merge($this->getCommonData(), [
                'title' => 'Contact | Abel Kpokouta',
                'validation' => $this->validator
            ]);
            return view('messages/contact', $data);
        }
        
        $model = new MessageModel();
        $model->save([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message')
        ]);
        
        return redirect()->to('/contact')->with('success', '✅ Message envoyé avec succès ! Je vous répondrai dans les plus brefs délais.');
    }
    
    public function apiContact()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON(['error' => 'Méthode non autorisée']);
        }
        
        $validation = $this->validate([
            'name'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email',
            'subject' => 'required|min_length[5]|max_length[200]',
            'message' => 'required|min_length[10]|max_length[2000]'
        ]);
        
        if (!$validation) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        
        $model = new MessageModel();
        $model->save([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message')
        ]);
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Message envoyé avec succès'
        ]);
    }
}