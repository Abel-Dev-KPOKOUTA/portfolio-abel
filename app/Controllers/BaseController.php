<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PortfolioModel;

class BaseController extends Controller
{
    protected $helpers = ['form', 'url', 'text'];
    protected $portfolioModel;
    protected $settings;
    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        try {
            // Initialiser le modèle
            $this->portfolioModel = new PortfolioModel();
            
            // Charger les settings
            $this->settings = $this->portfolioModel->getSettings();
            
        } catch (\Exception $e) {
            // Log l'erreur mais ne bloque pas l'application
            log_message('error', 'BaseController init error: ' . $e->getMessage());
            $this->settings = [];
        }
    }
    
    protected function getCommonData()
    {
        try {
            $data = [
                'settings' => $this->settings ?: []
            ];
            
            // Charger les données seulement si le modèle fonctionne
            if ($this->portfolioModel) {
                $data['featured_projects'] = $this->portfolioModel->getFeaturedProjects(3) ?: [];
                $data['skills'] = $this->portfolioModel->getSkillsByCategory() ?: [];
            } else {
                $data['featured_projects'] = [];
                $data['skills'] = [];
            }
            
            return $data;
            
        } catch (\Exception $e) {
            log_message('error', 'getCommonData error: ' . $e->getMessage());
            return [
                'settings' => [],
                'featured_projects' => [],
                'skills' => []
            ];
        }
    }


    /**
     * Convertir une date en format "il y a..."
     */
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
    
}