<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortfolioModel;

class SettingController extends BaseController
{
    protected $portfolioModel;

    public function __construct()
    {
        $this->portfolioModel = new PortfolioModel();
    }

    public function index()
    {
        $this->checkAdminAccess();

        $data = [
            'title' => 'Paramètres du Site - Admin',
            'settings' => $this->settings
        ];

        return view('admin/settings/index', $data);
    }

    public function update()
    {
        $this->checkAdminAccess();

        $settingsToUpdate = [
            'site_title',
            'site_description', 
            'admin_email',
            'github_url',
            'linkedin_url',
            'twitter_url',
            'instagram_url',
            'cv_file'
        ];

        foreach ($settingsToUpdate as $key) {
            $value = $this->request->getPost($key);
            if ($value !== null) {
                $this->updateSetting($key, $value);
            }
        }

        // Gestion du téléchargement du CV
        $cvFile = $this->request->getFile('cv_file_upload');
        if ($cvFile && $cvFile->isValid() && !$cvFile->hasMoved()) {
            $newName = 'abel_kpokouta_cv.pdf';
            $cvFile->move(ROOTPATH . 'public/assets/cv', $newName, true);
        }

        log_message('info', 'Paramètres du site mis à jour');
        return redirect()->to('/admin/parametres')->with('success', 'Paramètres mis à jour avec succès !');
    }

    private function updateSetting($key, $value)
    {
        $setting = $this->portfolioModel->where('setting_key', $key)->first();
        
        if ($setting) {
            $this->portfolioModel->update($setting->id, ['setting_value' => $value]);
        } else {
            $this->portfolioModel->insert([
                'setting_key' => $key,
                'setting_value' => $value,
                'setting_type' => 'string'
            ]);
        }
    }

    private function checkAdminAccess()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Veuillez vous connecter');
        }
    }
}