<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login()
    {
        // Rediriger vers le dashboard si déjà connecté
        if (session()->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Connexion Admin - Abel Kpokouta',
            'settings' => $this->settings
        ];

        return view('admin/auth/login', $data);
    }

    public function attemptLogin()
    {
        $validation = $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error', 'Veuillez remplir tous les champs');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 🔐 IDENTIFIANTS - À CHANGER EN PRODUCTION !
        $validUsername = 'admin';
        $validPassword = 'Abel2024!';

        if ($username === $validUsername && $password === $validPassword) {
            // Connexion réussie
            session()->set([
                'admin_logged_in' => true,
                'admin_username' => $username,
                'admin_login_time' => time()
            ]);

            log_message('info', "Connexion admin réussie: {$username}");
            return redirect()->to('/admin/dashboard')->with('success', 'Connexion réussie !');
        }

        log_message('warning', "Tentative de connexion admin échouée: {$username}");
        return redirect()->back()->withInput()->with('error', 'Identifiants incorrects');
    }

    public function logout()
    {
        $username = session()->get('admin_username');
        
        session()->remove(['admin_logged_in', 'admin_username', 'admin_login_time']);
        session()->destroy();

        log_message('info', "Déconnexion admin: {$username}");
        return redirect()->to('/admin/login')->with('success', 'Déconnexion réussie');
    }
}