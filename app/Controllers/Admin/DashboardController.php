<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\MessageModel;

class DashboardController extends BaseController
{
    public function index()
    {
        // 🔐 Vérification simple de l'authentification
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Veuillez vous connecter');
        }

        try {
            $projectModel = new ProjectModel();
            $messageModel = new MessageModel();

            // 🔴 CORRECTION: Utiliser findAll() au lieu de find()
            $recent_messages = $messageModel->orderBy('created_at', 'DESC')->limit(5)->findAll();
            $recent_projects = $projectModel->orderBy('created_at', 'DESC')->limit(5)->findAll();

            $data = [
                'title' => 'Tableau de Bord - Admin',
                'settings' => $this->settings ?? [],
                'stats' => [
                    'total_projects' => $projectModel->countAll(),
                    'featured_projects' => $projectModel->where('featured', 1)->countAllResults(),
                    'unread_messages' => $messageModel->where('is_read', 0)->countAllResults(),
                    'total_messages' => $messageModel->countAll(),
                    // 🔴 AJOUTER AVEC GESTION D'ERREUR
                    'total_skills' => $this->getSkillsCount(),
                    'upcoming_events' => $this->getUpcomingEventsCount(),
                    'archived_messages' => $messageModel->where('is_archived', 1)->countAllResults()
                ],
                'recent_messages' => $recent_messages,
                'recent_projects' => $recent_projects
            ];

            return view('admin/dashboard', $data);

        } catch (\Exception $e) {
            log_message('error', 'DashboardController Error: ' . $e->getMessage());
            
            // Retourner à la version simple en cas d'erreur
            return $this->getFallbackDashboard();
        }
    }

    /**
     * Compter les compétences avec gestion d'erreur
     */
    private function getSkillsCount()
    {
        try {
            if (class_exists('App\Models\SkillModel')) {
                $skillModel = new \App\Models\SkillModel();
                return $skillModel->where('is_active', 1)->countAllResults();
            }
        } catch (\Exception $e) {
            log_message('error', 'Erreur SkillModel: ' . $e->getMessage());
        }
        return 0;
    }

    /**
     * Compter les événements à venir avec gestion d'erreur
     */
    private function getUpcomingEventsCount()
    {
        try {
            if (class_exists('App\Models\EventModel')) {
                $eventModel = new \App\Models\EventModel();
                return $eventModel->where('event_date >=', date('Y-m-d'))->countAllResults();
            }
        } catch (\Exception $e) {
            log_message('error', 'Erreur EventModel: ' . $e->getMessage());
        }
        return 0;
    }

    /**
     * Dashboard de secours en cas d'erreur grave
     */
    private function getFallbackDashboard()
    {
        $data = [
            'title' => 'Tableau de Bord - Admin',
            'settings' => $this->settings ?? [],
            'stats' => [
                'total_projects' => 0,
                'featured_projects' => 0,
                'unread_messages' => 0,
                'total_messages' => 0,
                'total_skills' => 0,
                'upcoming_events' => 0,
                'archived_messages' => 0
            ],
            'recent_messages' => [],
            'recent_projects' => []
        ];

        return view('admin/dashboard', $data);
    }
}