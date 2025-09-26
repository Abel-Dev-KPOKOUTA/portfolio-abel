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


    public function show($slug)
    {
        $projectModel = new ProjectModel();
        $project = $projectModel->where('slug', $slug)->first();
        
        if (!$project || (is_array($project) && empty($project))) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Convertir en tableau si c'est un objet
        if (is_object($project)) {
            $project = (array)$project;
        }

        $data = [
            'title' => $project['title'] . ' - Portfolio',
            'project' => $project,
            'settings' => $this->getCommonData()['settings'] // ou votre méthode pour les settings
        ];

        return view('projects/project_detail', $data);
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
            'featured' => $this->request->getPost('featured') ? 1 : 0,
            'status' => $this->request->getPost('status') ? 'active' : 'inactive'
        ];

        // Gestion de l'upload d'image - LOGIQUE CORRIGÉE
        $image = $this->request->getFile('image');
        $removeImage = $this->request->getPost('remove_image');

        // PRIORITÉ 1 : Si une nouvelle image est uploadée
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Supprimer l'ancienne image si elle existe
            if (!empty($project['image']) && file_exists(ROOTPATH . 'public/assets/images/projects/' . $project['image'])) {
                unlink(ROOTPATH . 'public/assets/images/projects/' . $project['image']);
            }
            
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/assets/images/projects', $newName);
            $projectData['image'] = $newName;
        }
        // PRIORITÉ 2 : Si la checkbox "supprimer" est cochée ET qu'aucune nouvelle image n'est uploadée
        else if ($removeImage && !empty($project['image'])) {
            if (file_exists(ROOTPATH . 'public/assets/images/projects/' . $project['image'])) {
                unlink(ROOTPATH . 'public/assets/images/projects/' . $project['image']);
            }
            $projectData['image'] = null;
        }
        // PRIORITÉ 3 : Si on veut garder l'image actuelle (rien ne change)
        else {
            // Garder l'image actuelle - pas de modification
            $projectData['image'] = $project['image'];
        }

        if ($this->projectModel->save($projectData)) {
            log_message('info', "Projet modifié ID: {$id}");
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

        // Supprimer l'image si elle existe - SYNTAXE TABLEAU CORRIGÉE
        if (!empty($project['image']) && file_exists(ROOTPATH . 'public/assets/images/projects/' . $project['image'])) {
            unlink(ROOTPATH . 'public/assets/images/projects/' . $project['image']);
        }

        if ($this->projectModel->delete($id)) {
            log_message('info', "Projet supprimé ID: {$id}");
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