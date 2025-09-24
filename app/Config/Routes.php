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

// Pages projets
$routes->get('/projets', [Home::class, 'projects']);
$routes->get('/projects', [Home::class, 'projects']); // Version anglaise
$routes->get('/projet/(:segment)', [ProjectController::class, 'show']);
$routes->get('/project/(:segment)', [ProjectController::class, 'show']); // Version anglaise

// Diagnostic
$routes->get('/real-diagnostic', 'RealDiagnostic::index');
$routes->get('/test-queries', 'RealDiagnostic::testQueries');

// Contact
$routes->get('/contact', [MessageController::class, 'contact']);
$routes->post('/contact', [MessageController::class, 'contact']);
$routes->match(['get', 'post'], '/contactez-moi', [MessageController::class, 'contact']); // Alternative

// Téléchargement CV
$routes->get('/telecharger-cv', [Home::class, 'downloadCV']);
$routes->get('/download-cv', [Home::class, 'downloadCV']); // Version anglaise

// Pages statiques (si besoin)
$routes->get('/a-propos', function() {
    return redirect()->to('/#about');
});

$routes->get('/competences', function() {
    return redirect()->to('/#skills');
});

$routes->get('/evenements', function() {
    return redirect()->to('/#events');
});

// =============================================
// ROUTES API (pour AJAX)
// =============================================

$routes->group('api', function($routes) {
    $routes->post('contact', [MessageController::class, 'apiContact']);
    $routes->get('projects', [ProjectController::class, 'apiProjects']);
    $routes->get('skills', [ProjectController::class, 'apiSkills']);
});

// =============================================
// ROUTES ADMIN (à protéger)
// =============================================


// Routes Admin
$routes->group('admin', function($routes) {
    // Authentification
    $routes->get('login', 'Admin\AuthController::login');
    $routes->post('login', 'Admin\AuthController::attemptLogin');
    $routes->get('logout', 'Admin\AuthController::logout');
    
    // Dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index', ['filter' => 'adminAuth']);
    
    // Projets
    $routes->get('projets', 'Admin\ProjectController::index', ['filter' => 'adminAuth']);
    $routes->get('projets/creer', 'Admin\ProjectController::create', ['filter' => 'adminAuth']);
    $routes->post('projets/creer', 'Admin\ProjectController::store', ['filter' => 'adminAuth']);
    $routes->get('projets/editer/(:num)', 'Admin\ProjectController::edit/$1', ['filter' => 'adminAuth']);
    $routes->post('projets/editer/(:num)', 'Admin\ProjectController::update/$1', ['filter' => 'adminAuth']);
    $routes->get('projets/supprimer/(:num)', 'Admin\ProjectController::delete/$1', ['filter' => 'adminAuth']);
    
    // Messages
    $routes->get('messages', 'Admin\MessageController::index', ['filter' => 'adminAuth']);
    $routes->get('messages/(:num)', 'Admin\MessageController::show/$1', ['filter' => 'adminAuth']);
    $routes->post('messages/(:num)/lu', 'Admin\MessageController::markAsRead/$1', ['filter' => 'adminAuth']);
    $routes->get('messages/(:num)/supprimer', 'Admin\MessageController::delete/$1', ['filter' => 'adminAuth']);
    
    // Paramètres
    $routes->get('parametres', 'Admin\SettingController::index', ['filter' => 'adminAuth']);
    $routes->post('parametres', 'Admin\SettingController::update', ['filter' => 'adminAuth']);
});



// =============================================
// ROUTES DE DÉVELOPPEMENT (à désactiver en production)
// =============================================

if (ENVIRONMENT !== 'production') {
    $routes->get('/test', 'TestController::index');
    $routes->get('/debug', 'TestController::debug');
    $routes->get('/seed', 'TestController::seedData');
}

// =============================================
// ROUTES D'ERREURS
// =============================================

$routes->set404Override(function() {
    return view('errors/404');
});

// =============================================
// ROUTES DE MAINTENANCE
// =============================================

$routes->get('/maintenance', function() {
    return view('errors/maintenance');
});

// Route par défaut (doit être en dernier)
$routes->get('(:any)', function($slug) {
    // Tentative de redirection intelligente
    $redirects = [
        'github' => 'https://github.com/abel',
        'linkedin' => 'https://linkedin.com/in/abel-kpokouta',
        'cv' => '/telecharger-cv',
        'portfolio' => '/projets'
    ];
    
    if (isset($redirects[strtolower($slug)])) {
        return redirect()->to($redirects[strtolower($slug)]);
    }
    
    // Si aucune correspondance, page 404
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
});




