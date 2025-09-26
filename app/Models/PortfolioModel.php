<?php namespace App\Models;

use CodeIgniter\Model;

class PortfolioModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['setting_key', 'setting_value', 'setting_type', 'description'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    public function getSettings()
    {
        try {
            $settings = $this->findAll();
            $result = [];
            foreach ($settings as $setting) {
                $result[$setting->setting_key] = $setting->setting_value;
            }
            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Erreur getSettings: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getFeaturedProjects($limit = null)
    {
        try {
            $projectModel = new \App\Models\ProjectModel();
            $projects = $projectModel->where('featured', 1)
                                  ->where('status', 'active')
                                  ->orderBy('created_at', 'DESC');
            
            if ($limit) {
                $projects = $projects->findAll($limit);
            } else {
                $projects = $projects->findAll();
            }
            
            return $projects;
        } catch (\Exception $e) {
            log_message('error', 'Erreur getFeaturedProjects: ' . $e->getMessage());
            return [];
        }
    }
    
  
    public function getAllProjects()
    {
        try {
            $projectModel = new \App\Models\ProjectModel();
            return $projectModel->where('status', 'active')
                            ->orderBy('created_at', 'DESC')
                            ->findAll();
        } catch (\Exception $e) {
            log_message('error', 'Erreur getAllProjects: ' . $e->getMessage());
            return [];
        }
    }

    
    public function getSkillsByCategory()
    {
        try {
            $skillModel = new \App\Models\SkillModel();
            $skills = $skillModel->where('is_active', 1)
                               ->orderBy('display_order', 'ASC')
                               ->findAll();
            
            $categorized = [];
            foreach ($skills as $skill) {
                $categorized[$skill->category][] = $skill;
            }
            return $categorized;
        } catch (\Exception $e) {
            log_message('error', 'Erreur getSkillsByCategory: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getExperiences()
    {
        try {
            $experienceModel = new \App\Models\ExperienceModel();
            return $experienceModel->orderBy('start_date', 'DESC')->findAll();
        } catch (\Exception $e) {
            log_message('error', 'Erreur getExperiences: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getFeaturedEvents($limit = 6)
    {
        try {
            $eventModel = new \App\Models\EventModel();
            $events = $eventModel->where('is_featured', 1)
                               ->orderBy('event_date', 'DESC');
            
            if ($limit) {
                $events = $events->findAll($limit);
            } else {
                $events = $events->findAll();
            }
            
            return $events;
        } catch (\Exception $e) {
            log_message('error', 'Erreur getFeaturedEvents: ' . $e->getMessage());
            return [];
        }
    }
}