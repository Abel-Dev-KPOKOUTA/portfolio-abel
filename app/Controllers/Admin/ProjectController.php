<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProjectModel;

class ProjectController extends BaseController
{
    protected $projectModel;

    public function __construct()
    {
        $this->projectModel = new ProjectModel();
    }

    public function index()
    {
        $this->checkAdminAccess();

        $data = [
            'title' => 'Gestion des Projets - Admin',
            'settings' => $this->settings,
            'projects' => $this->projectModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('admin/projects/index', $data);
    }

    public function create()
    {
        $this->checkAdminAccess();

        $data = [
            'title' => 'Nouveau Projet - Admin',
            'settings' => $this->settings
        ];

        return view('admin/projects/create', $data);
    }

    public function store()
    {
        $this->checkAdminAccess();

        $validation = $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'technologies' => 'required'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = url_title($this->request->getPost('title'), '-', true);

        $projectData = [
            'title' => $this->request->getPost('title'),
            'slug' => $slug,
            'description' => $this->request->getPost('description'),
            'full_description' => $this->request->getPost('full_description'),
            'technologies' => $this->request->getPost('technologies'),
            'github_url' => $this->request->getPost('github_url'),
            'demo_url' => $this->request->getPost('demo_url'),
            'featured' => $this->request->getPost('featured') ? 1 : 0,
            'status' => 'active'
        ];

        // Gestion de l'upload d'image
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/assets/images/projects', $newName);
            $projectData['image'] = $newName;
        }

        if ($this->projectModel->save($projectData)) {
            log_message('info', "Nouveau projet créé: {$projectData['title']}");
            return redirect()->to('/admin/projets')->with('success', 'Projet créé avec succès !');
        }

        return redirect()->back()->withInput()->with('error', 'Erreur lors de la création du projet');
    }

    public function edit($id)
    {
        $this->checkAdminAccess();

        $project = $this->projectModel->find($id);
        if (!$project) {
            return redirect()->to('/admin/projets')->with('error', 'Projet non trouvé');
        }

        $data = [
            'title' => 'Modifier le Projet - Admin',
            'settings' => $this->settings,
            'project' => $project
        ];

        return view('admin/projects/edit', $data);
    }

    public function update($id)
    {
        $this->checkAdminAccess();

        $project = $this->projectModel->find($id);
        if (!$project) {
            return redirect()->to('/admin/projets')->with('error', 'Projet non trouvé');
        }

        $validation = $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[10]',
            'technologies' => 'required'
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $slug = url_title($this->request->getPost('title'), '-', true);

        $projectData = [
            'id' => $id,
            'title' => $this->request->getPost('title'),
            'slug' => $slug,
            'description' => $this->request->getPost('description'),
            'full_description' => $this->request->getPost('full_description'),
            'technologies' => $this->request->getPost('technologies'),
            'github_url' => $this->request->getPost('github_url'),
            'demo_url' => $this->request->getPost('demo_url'),
            'featured' => $this->request->getPost('featured') ? 1 : 0
        ];

        // Gestion de l'upload d'image
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Supprimer l'ancienne image si elle existe
            if ($project->image && file_exists(ROOTPATH . 'public/assets/images/projects/' . $project->image)) {
                unlink(ROOTPATH . 'public/assets/images/projects/' . $project->image);
            }
            
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/assets/images/projects', $newName);
            $projectData['image'] = $newName;
        }

        if ($this->projectModel->save($projectData)) {
            log_message('info', "Projet modifié: {$projectData['title']}");
            return redirect()->to('/admin/projets')->with('success', 'Projet modifié avec succès !');
        }

        return redirect()->back()->withInput()->with('error', 'Erreur lors de la modification du projet');
    }

    public function delete($id)
    {
        $this->checkAdminAccess();

        $project = $this->projectModel->find($id);
        if (!$project) {
            return redirect()->to('/admin/projets')->with('error', 'Projet non trouvé');
        }

        // Supprimer l'image si elle existe
        if ($project->image && file_exists(ROOTPATH . 'public/assets/images/projects/' . $project->image)) {
            unlink(ROOTPATH . 'public/assets/images/projects/' . $project->image);
        }

        if ($this->projectModel->delete($id)) {
            log_message('info', "Projet supprimé: {$project->title}");
            return redirect()->to('/admin/projets')->with('success', 'Projet supprimé avec succès !');
        }

        return redirect()->to('/admin/projets')->with('error', 'Erreur lors de la suppression du projet');
    }

    private function checkAdminAccess()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Veuillez vous connecter');
        }
    }
}