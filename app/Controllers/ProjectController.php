<?php namespace App\Controllers;

use App\Models\ProjectModel;

class ProjectController extends BaseController
{
    protected $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        // Charger les settings si nécessaire (hérité de BaseController)
    }

    public function show($slug)
    {
        $project = $this->projectModel->where('slug', $slug)->first();
        
        if (!$project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Convertir en tableau si c'est un objet
        if (is_object($project)) {
            $project = (array)$project;
        }

        $data = [
            'title' => $project['title'] . ' - Portfolio',
            'project' => $project,
            'settings' => $this->settings // Hérité de BaseController
        ];
        
        return view('projects/project_detail', $data);
    }
}