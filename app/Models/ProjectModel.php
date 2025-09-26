<?php namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table      = 'projects';
    protected $primaryKey = 'id';
    
    // 🔴 AJOUTER TOUS LES CHAMPS DE VOTRE TABLE
    protected $allowedFields = [
        'title', 'slug', 'description', 'full_description', 
        'technologies', 'github_url', 'demo_url', 'image', 
        'featured', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Récupérer les projets vedettes
    public function getFeaturedProjects($limit = null)
    {
        $query = $this->where('featured', 1)
                     ->where('status', 'active')
                     ->orderBy('created_at', 'DESC');
        
        if ($limit) {
            return $query->findAll($limit);
        }
        
        return $query->findAll();
    }

    // Récupérer un projet par son slug
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    // Récupérer tous les projets actifs
    public function getAllActive()
    {
        return $this->where('status', 'active')
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }
}