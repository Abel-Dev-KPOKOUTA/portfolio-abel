<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MessageModel;

class MessageController extends BaseController
{
    protected $messageModel;
    protected $settings;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
        
        // 🔴 CORRECTION : Charger les settings depuis le BaseController
        $commonData = $this->getCommonData();
        $this->settings = $commonData['settings'] ?? [];
    }

    public function index()
    {
        $this->checkAdminAccess();

        // 🔴 CORRECTION : Récupérer les messages avec gestion d'erreur
        try {
            $messages = $this->messageModel->orderBy('created_at', 'DESC')->findAll();
        } catch (\Exception $e) {
            log_message('error', 'Erreur récupération messages: ' . $e->getMessage());
            $messages = [];
        }

        $data = [
            'title' => 'Messages reçus - Admin',
            'settings' => $this->settings,
            'messages' => $messages
        ];

        return view('admin/messages/index', $data);
    }









/*
    public function show($id = null)
    {
        $this->checkAdminAccess();

        if ($id === null) {
            return redirect()->to('/admin/messages')->with('error', 'Aucun message spécifié');
        }

        // Utiliser l'instance existante de messageModel
        $message = $this->messageModel->find($id);
        
        if (!$message) {
            return redirect()->to('/admin/messages')->with('error', 'Message non trouvé');
        }

        // 🔴 CORRECTION : Marquer comme lu de façon plus robuste
        if (!$message['is_read']) {
            try {
                $this->messageModel->update($id, ['is_read' => 1]);
                // Recharger le message pour avoir la version mise à jour
                $message = $this->messageModel->find($id);
            } catch (\Exception $e) {
                log_message('error', 'Erreur marquage message lu: ' . $e->getMessage());
            }
        }

        // 🔴 CORRECTION : Navigation avec la même instance
        try {
            $previous_message = $this->messageModel
                ->where('id <', $id)
                ->orderBy('id', 'DESC')
                ->first();

            $next_message = $this->messageModel
                ->where('id >', $id)
                ->orderBy('id', 'ASC')
                ->first();
        } catch (\Exception $e) {
            log_message('error', 'Erreur navigation messages: ' . $e->getMessage());
            $previous_message = null;
            $next_message = null;
        }

        $data = [
            'title' => 'Message - ' . $message['subject'],
            'settings' => $this->settings,
            'message' => $message,
            'previous_message' => $previous_message,
            'next_message' => $next_message
        ];

        return view('admin/messages/show', $data);
    }

    






    public function markAsRead($id)
    {
        $this->checkAdminAccess();

        $message = $this->messageModel->find($id);
        
        if (!$message) {
            return redirect()->to('/admin/messages')->with('error', 'Message non trouvé');
        }

        // Marquer comme lu
        try {
            $this->messageModel->update($id, ['is_read' => 1]);
            return redirect()->back()->with('success', 'Message marqué comme lu');
        } catch (\Exception $e) {
            log_message('error', 'Erreur markAsRead: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors du marquage comme lu');
        }
    }

*/


    public function show($id = null)
    {
        $this->checkAdminAccess();

        if ($id === null) {
            return redirect()->to('/admin/messages')->with('error', 'Aucun message spécifié');
        }

        // Utiliser l'instance existante de messageModel
        $message = $this->messageModel->find($id);
        
        if (!$message) {
            return redirect()->to('/admin/messages')->with('error', 'Message non trouvé');
        }

        // 🔴 SUPPRIMER le marquage automatique ici
        // Le message sera marqué comme lu SEULEMENT via le bouton
        
        // Navigation avec la même instance
        try {
            $previous_message = $this->messageModel
                ->where('id <', $id)
                ->orderBy('id', 'DESC')
                ->first();

            $next_message = $this->messageModel
                ->where('id >', $id)
                ->orderBy('id', 'ASC')
                ->first();
        } catch (\Exception $e) {
            log_message('error', 'Erreur navigation messages: ' . $e->getMessage());
            $previous_message = null;
            $next_message = null;
        }

        $data = [
            'title' => 'Message - ' . $message['subject'],
            'settings' => $this->settings,
            'message' => $message,
            'previous_message' => $previous_message,
            'next_message' => $next_message
        ];

        return view('admin/messages/show', $data);
    }




    public function markAsRead($id)
    {
        $this->checkAdminAccess();

        try {
            $db = \Config\Database::connect();
            
            // Marquer le message comme lu
            $result = $db->table('messages')
                        ->where('id', $id)
                        ->set('is_read', 1)
                        ->update();

            if ($result) {
                return redirect()->back()->with('success', 'Message marqué comme lu avec succès !');
            } else {
                return redirect()->back()->with('error', 'Erreur lors du marquage du message');
            }

        } catch (\Exception $e) {
            log_message('error', 'Erreur markAsRead: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur technique');
        }
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

    public function archive($id)
    {
        $this->checkAdminAccess();

        if ($this->messageModel->update($id, ['is_archived' => 1])) {
            return redirect()->back()->with('success', 'Message archivé');
        }
        return redirect()->back()->with('error', 'Erreur lors de l\'archivage');
    }

    public function archived()
    {
        $this->checkAdminAccess();

        $data = [
            'title' => 'Messages Archivés - Admin',
            'settings' => $this->settings,
            'messages' => $this->messageModel->where('is_archived', 1)->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('admin/messages/archived', $data);
    }


        // Ajoutez cette méthode dans Admin/MessageController.php
    protected function timeAgo($datetime)
    {
        $time = strtotime($datetime);
        $now = time();
        $diff = $now - $time;
        
        if ($diff < 60) {
            return 'À l\'instant';
        } elseif ($diff < 3600) {
            return 'Il y a ' . round($diff / 60) . ' min';
        } elseif ($diff < 86400) {
            return 'Il y a ' . round($diff / 3600) . ' h';
        } elseif ($diff < 2592000) {
            return 'Il y a ' . round($diff / 86400) . ' j';
        } else {
            return date('d/m/Y', $time);
        }
    }

    public function abel()
    {
        return view('admin/messages/show');
    }

}