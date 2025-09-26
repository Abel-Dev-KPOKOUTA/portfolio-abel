<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // URLs exemptées du filtre (login, logout)
        $excludedUrls = ['admin/login', 'admin/logout']; // ← ENLEVER LES SLASHES DE DÉBUT
        $currentUrl = uri_string();
        
        // Debug: Voir ce qui se passe
        // echo "Current URL: " . $currentUrl . "<br>";
        // echo "Excluded URLs: " . implode(', ', $excludedUrls) . "<br>";
        
        // Si on est sur une URL exemptée, ne pas appliquer le filtre
        if (in_array($currentUrl, $excludedUrls)) {
            return;
        }
        
        // Vérifier si l'admin est connecté
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login')->with('error', 'Veuillez vous connecter pour accéder à cette page');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Ne rien faire après
    }
}