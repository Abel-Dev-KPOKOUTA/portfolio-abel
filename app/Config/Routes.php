<?php

use App\Controllers\Home;
use App\Controllers\ProjectController;
use App\Controllers\MessageController;

// =============================================
// ROUTES PRINCIPALES DU PORTFOLIO
// =============================================

// Page d'accueil
$routes->get('/', [Home::class, 'index']);
$routes->get('/accueil', [Home::class, 'index']);
$routes->get('/test' , [Home::class, 'test']);

// Pages projets
$routes->get('/projets', [Home::class, 'projects']);
$routes->get('/projects', [Home::class, 'projects']);


// Par cette version corrigée
$routes->get('/projet/(:segment)', [ProjectController::class, 'show']);
$routes->get('/project/(:segment)', [ProjectController::class, 'show']);


// Contact
$routes->get('/contact', [MessageController::class, 'contact']);
$routes->post('/contact', [MessageController::class, 'contact']);

// Téléchargement CV
$routes->get('/telecharger-cv', [Home::class, 'downloadCV']);
$routes->get('/download-cv', [Home::class, 'downloadCV']);

// =============================================
// ROUTES API
// =============================================

$routes->group('api', function($routes) {
    $routes->post('contact', [MessageController::class, 'apiContact']);
   // $routes->get('projects', [ProjectController::class, 'apiProjects']);
    //$routes->get('skills', [ProjectController::class, 'apiSkills']);
});

// =============================================
// ROUTES ADMIN - VERSION CORRIGÉE
// =============================================

// 🔐 PAGES D'AUTHENTIFICATION (EN DEHORS DU GROUPE)
$routes->get('admin/login', 'Admin\AuthController::login');
$routes->post('admin/login', 'Admin\AuthController::attemptLogin');
$routes->get('admin/logout', 'Admin\AuthController::logout');

// 📊 PAGES PROTÉGÉES (AVEC FILTRE SIMPLIFIÉ)
$routes->group('admin', ['filter' => 'adminAuth'], function($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    // CRUD Projets
    $routes->get('projets', 'Admin\ProjectController::index');
    $routes->get('projets/creer', 'Admin\ProjectController::create');
    $routes->post('projets/creer', 'Admin\ProjectController::store');
    $routes->get('projets/editer/(:num)', 'Admin\ProjectController::edit/$1');
    $routes->post('projets/editer/(:num)', 'Admin\ProjectController::update/$1');
    $routes->get('projets/supprimer/(:num)', 'Admin\ProjectController::delete/$1');
    $routes->get('abel' ,"Admin\MessageController::abel");

    $routes->get('messages', 'Admin\MessageController::index');
    $routes->get('messages/(:num)', 'Admin\MessageController::show/$1');
    $routes->post('messages/(:num)/lu', 'Admin\MessageController::markAsRead/$1');
    $routes->get('messages/(:num)/supprimer', 'Admin\MessageController::delete/$1');
    $routes->get('parametres', 'Admin\SettingController::index');
    $routes->post('parametres', 'Admin\SettingController::update');
});


// =============================================
// ROUTES D'ERREURS
// =============================================

$routes->set404Override(function() {
    return view('errors/404');
});

// Route par défaut
$routes->get('(:any)', function($slug) {
    $redirects = [
        'github' => 'https://github.com/abel',
        'linkedin' => 'https://linkedin.com/in/abel-kpokouta',
        'cv' => '/telecharger-cv',
        'portfolio' => '/projets',
        'admin' => '/admin/login'
    ];
    
    if (isset($redirects[strtolower($slug)])) {
        return redirect()->to($redirects[strtolower($slug)]);
    }
    
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
});



