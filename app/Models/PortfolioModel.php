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
            // CORRECTION : Utiliser model() au lieu de new
            $projectModel = model('ProjectModel');
            return $projectModel->where('featured', 1)
                              ->where('status', 'active')
                              ->orderBy('created_at', 'DESC')
                              ->findAll($limit);
        } catch (\Exception $e) {
            log_message('error', 'Erreur getFeaturedProjects: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getAllProjects()
    {
        try {
            // CORRECTION ICI AUSSI
            $projectModel = model('ProjectModel');
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
            // CORRECTION ICI AUSSI
            $skillModel = model('SkillModel');
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
            // CORRECTION ICI AUSSI
            $experienceModel = model('ExperienceModel');
            return $experienceModel->orderBy('start_date', 'DESC')->findAll();
        } catch (\Exception $e) {
            log_message('error', 'Erreur getExperiences: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getFeaturedEvents($limit = 6)
    {
        try {
            // CORRECTION ICI AUSSI
            $eventModel = model('EventModel');
            return $eventModel->where('is_featured', 1)
                             ->orderBy('event_date', 'DESC')
                             ->findAll($limit);
        } catch (\Exception $e) {
            log_message('error', 'Erreur getFeaturedEvents: ' . $e->getMessage());
            return [];
        }
    }
}