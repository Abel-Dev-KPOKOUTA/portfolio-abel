<?php namespace App\Controllers;

use App\Models\ProjectModel;

class ProjectController extends BaseController
{
    public function show($slug)
    {
        $projectModel = new ProjectModel();
        $project = $projectModel->getBySlug($slug);
        
        if (!$project) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Projet '$slug' introuvable.");
        }
        
        $data = array_merge($this->getCommonData(), [
            'title' => $project->title . ' | Abel Kpokouta',
            'project' => $project,
            'meta_description' => $project->description
        ]);
        
        return view('projects/show', $data);
    }
    
    public function apiProjects()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON(['error' => 'Méthode non autorisée']);
        }
        
        $projectModel = new ProjectModel();
        $projects = $projectModel->where('status', 'active')
                               ->orderBy('created_at', 'DESC')
                               ->findAll();
        
        return $this->response->setJSON([
            'success' => true,
            'data' => $projects
        ]);
    }
    
    public function apiSkills()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405)->setJSON(['error' => 'Méthode non autorisée']);
        }
        
        $portfolioModel = new \App\Models\PortfolioModel();
        $skills = $portfolioModel->getSkillsByCategory();
        
        return $this->response->setJSON([
            'success' => true,
            'data' => $skills
        ]);
    }
}