<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MessageModel;

class MessageController extends BaseController
{
    protected $messageModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
    }

    public function index()
    {
        $this->checkAdminAccess();

        $data = [
            'title' => 'Messages reçus - Admin',
            'settings' => $this->settings,
            'messages' => $this->messageModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('admin/messages/index', $data);
    }

    public function show($id)
    {
        $this->checkAdminAccess();

        $message = $this->messageModel->find($id);
        if (!$message) {
            return redirect()->to('/admin/messages')->with('error', 'Message non trouvé');
        }

        // Marquer comme lu
        if (!$message->is_read) {
            $this->messageModel->update($id, ['is_read' => 1]);
        }

        $data = [
            'title' => 'Message - Admin',
            'settings' => $this->settings,
            'message' => $message
        ];

        return view('admin/messages/show', $data);
    }

    public function markAsRead($id)
    {
        $this->checkAdminAccess();

        if ($this->messageModel->update($id, ['is_read' => 1])) {
            return redirect()->back()->with('success', 'Message marqué comme lu');
        }

        return redirect()->back()->with('error', 'Erreur lors du marquage du message');
    }

    public function delete($id)
    {
        $this->checkAdminAccess();

        if ($this->messageModel->delete($id)) {
            log_message('info', "Message supprimé: ID {$id}");
            return redirect()->to('/admin/messages')->with('success', 'Message supprimé avec succès !');
        }

        return redirect()->to('/admin/messages')->with('error', 'Erreur lors de la suppression du message');
    }

    private function checkAdminAccess()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Veuillez vous connecter');
        }
    }
}