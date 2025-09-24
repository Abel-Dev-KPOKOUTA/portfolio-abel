<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\MessageModel;
use App\Models\PortfolioModel;

class DashboardController extends BaseController
{
    protected $portfolioModel;

    public function __construct()
    {
        $this->portfolioModel = new PortfolioModel();
    }

    public function index()
    {
        $this->checkAdminAccess();

        $projectModel = new ProjectModel();
        $messageModel = new MessageModel();

        $data = [
            'title' => 'Tableau de Bord - Admin',
            'settings' => $this->settings,
            'stats' => [
                'total_projects' => $projectModel->countAll(),
                'featured_projects' => $projectModel->where('featured', 1)->countAllResults(),
                'unread_messages' => $messageModel->where('is_read', 0)->countAllResults(),
                'total_messages' => $messageModel->countAll()
            ],
            'recent_messages' => $messageModel->orderBy('created_at', 'DESC')->limit(5)->find(),
            'recent_projects' => $projectModel->orderBy('created_at', 'DESC')->limit(5)->find()
        ];

        return view('admin/dashboard', $data);
    }

    private function checkAdminAccess()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Veuillez vous connecter');
        }
    }
}