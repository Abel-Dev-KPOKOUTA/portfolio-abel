<?php namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table      = 'projects';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'title', 'description', 'technologies', 'image', 'slug', 'featured'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // 🔎 Exemple de fonction personnalisée
    public function getFeaturedProjects()
    {
        return $this->where('featured', 1)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
}


