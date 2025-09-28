<?php namespace App\Controllers;

use App\Models\MessageModel;

class MessageController extends BaseController
{
    public function contact()
    {
        $data = array_merge($this->getCommonData(), [
            'title' => 'Contact | Abel Kpokouta',
            'meta_description' => 'Contactez Abel Kpokouta pour discuter de projets, collaborations ou opportunités.'
        ]);
        
        if ($this->request->getMethod() === 'post') {
            return $this->processContact($data);
        }
        
        return view('messages/contact', $data);
    }
    
    private function processContact($baseData)
    {
        // 🔴 CORRECTION : Utiliser la bonne syntaxe pour la validation
        $validationRules = [
            'name'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email',
            'subject' => 'required|min_length[5]|max_length[200]',
            'message' => 'required|min_length[10]|max_length[2000]'
        ];
        
        if (!$this->validate($validationRules)) {
            // 🔴 CORRECTION : Passer les erreurs de validation à la vue
            return view('messages/contact', array_merge($baseData, [
                'validation' => $this->validator
            ]));
        }
        
        try {
            $model = new MessageModel();
            
            // 🔴 CORRECTION : Ajouter l'IP et le user agent
            $messageData = [
                'name'       => $this->request->getPost('name'),
                'email'      => $this->request->getPost('email'),
                'subject'    => $this->request->getPost('subject'),
                'message'    => $this->request->getPost('message'),
                'ip_address' => $this->request->getIPAddress(),
                'user_agent' => $this->request->getUserAgent()->getAgentString(),
                'is_read'    => 0,
                'is_archived' => 0
            ];
            
            if ($model->save($messageData)) {
                log_message('info', 'Nouveau message de contact: ' . $messageData['email']);
                return redirect()->to('/contact')->with('success', '✅ Message envoyé avec succès ! Je vous répondrai dans les plus brefs délais.');
            } else {
                throw new \Exception('Erreur lors de la sauvegarde du message');
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Erreur formulaire contact: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'envoi du message. Veuillez réessayer.');
        }
    }
    
    public function apiContact()
    {
        // 🔴 CORRECTION : Vérifier que c'est bien une requête AJAX
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
        
        try {
            $model = new MessageModel();
            $model->save([
                'name'    => $this->request->getPost('name'),
                'email'   => $this->request->getPost('email'),
                'subject' => $this->request->getPost('subject'),
                'message' => $this->request->getPost('message'),
                'ip_address' => $this->request->getIPAddress(),
                'user_agent' => $this->request->getUserAgent()->getAgentString()
            ]);
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Message envoyé avec succès'
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Erreur API contact: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Erreur serveur'
            ]);
        }
    }
}