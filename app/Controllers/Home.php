<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Données de base
        $data = [
            'title' => 'Abel Kpokouta - Portfolio | Data Scientist',
            'meta_description' => 'Portfolio d\'Abel Kpokouta, étudiant en Génie Mathématique et Data Scientist.'
        ];
        
        try {
            // Vérifier et charger le modèle PortfolioModel
            if (class_exists('App\Models\PortfolioModel')) {
                $portfolioModel = new \App\Models\PortfolioModel();
                
                // Charger toutes les données avec gestion individuelle des erreurs
                $portfolioData = [
                    'settings' => $this->loadSettings($portfolioModel),
                    'projects' => $this->loadFeaturedProjects($portfolioModel),
                    'experiences' => $this->loadExperiences($portfolioModel),
                    'events' => $this->loadFeaturedEvents($portfolioModel),
                    'skills' => $this->loadSkills($portfolioModel)
                ];
                
                $data = array_merge($data, $portfolioData);
                
            } else {
                throw new \Exception('PortfolioModel non trouvé');
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Erreur contrôleur Home: ' . $e->getMessage());
            $data = $this->getFallbackData($data);
        }
        
        return view('home', $data);
    }
    
    /**
     * Charger les paramètres avec gestion d'erreur
     */
    private function loadSettings($portfolioModel)
    {
        try {
            $settings = $portfolioModel->getSettings();
            return !empty($settings) ? $settings : $this->getDefaultSettings();
        } catch (\Exception $e) {
            log_message('error', 'Erreur chargement settings: ' . $e->getMessage());
            return $this->getDefaultSettings();
        }
    }
    
    /**
     * Charger les projets featured
     */
    private function loadFeaturedProjects($portfolioModel)
    {
        try {
            $projects = $portfolioModel->getFeaturedProjects(6);
            
            // Si aucun projet featured, prendre les derniers projets actifs
            if (empty($projects)) {
                log_message('info', 'Aucun projet featured trouvé, chargement des derniers projets');
                $allProjects = $portfolioModel->getAllProjects();
                $projects = is_array($allProjects) ? array_slice($allProjects, 0, 6) : [];
            }
            
            return $projects ?? [];
        } catch (\Exception $e) {
            log_message('error', 'Erreur chargement projets: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Charger les expériences
     */
    private function loadExperiences($portfolioModel)
    {
        try {
            $experiences = $portfolioModel->getExperiences();
            return is_array($experiences) ? $experiences : [];
        } catch (\Exception $e) {
            log_message('error', 'Erreur chargement expériences: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Charger les événements featured
     */
    private function loadFeaturedEvents($portfolioModel)
    {
        try {
            $events = $portfolioModel->getFeaturedEvents(6);
            return is_array($events) ? $events : [];
        } catch (\Exception $e) {
            log_message('error', 'Erreur chargement événements: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Charger les compétences par catégorie
     */
    private function loadSkills($portfolioModel)
    {
        try {
            $skills = $portfolioModel->getSkillsByCategory();
            
            // S'assurer que la structure est correcte
            if (!is_array($skills) || empty($skills)) {
                return [];
            }
            
            return $skills;
        } catch (\Exception $e) {
            log_message('error', 'Erreur chargement compétences: ' . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Données par défaut en cas d'erreur
     */
    private function getFallbackData($baseData)
    {
        return array_merge($baseData, [
            'settings' => $this->getDefaultSettings(),
            'projects' => [],
            'experiences' => [],
            'events' => [],
            'skills' => []
        ]);
    }
    
    /**
     * Paramètres par défaut
     */
    private function getDefaultSettings()
    {
        return [
            'site_title' => 'Abel Kpokouta - Portfolio',
            'site_description' => 'Étudiant en Génie Mathématique et Data Scientist',
            'admin_email' => 'abel.kpokouta@example.com',
            'github_url' => 'https://github.com/abel',
            'linkedin_url' => 'https://linkedin.com/in/abel-kpokouta',
            'twitter_url' => 'https://twitter.com/abel',
            'instagram_url' => 'https://instagram.com/abel.kpokouta',
            'cv_file' => 'abel_kpokouta_cv.pdf'
        ];
    }


    public function projects()
    {
        try {
            $data = [
                'title' => 'Mes Projets | Abel Kpokouta',
                'meta_description' => 'Découvrez tous mes projets en développement web, data science et cybersécurité.'
            ];
            
            // Charger les projets avec gestion d'erreur améliorée
            if (class_exists('App\Models\PortfolioModel')) {
                $portfolioModel = new \App\Models\PortfolioModel();
                
                // 🔴 UTILISER LA BONNE MÉTHODE
                $projects = $portfolioModel->getAllProjects();
                $settings = $portfolioModel->getSettings();
                
                // 🔴 DEBUG TEMPORAIRE
                log_message('info', 'Nombre de projets chargés: ' . count($projects));
                if (!empty($projects)) {
                    log_message('info', 'Premier projet: ' . print_r($projects[0], true));
                }
                
                $data['projects'] = is_array($projects) ? $projects : [];
                $data['settings'] = is_array($settings) ? $settings : $this->getDefaultSettings();
                
            } else {
                $data['projects'] = [];
                $data['settings'] = $this->getDefaultSettings();
            }
            
            return view('projects/index', $data);
            
        } catch (\Exception $e) {
            log_message('error', 'Erreur page projets: ' . $e->getMessage());
            
            return view('projects/index', [
                'title' => 'Mes Projets | Abel Kpokouta',
                'projects' => [],
                'settings' => $this->getDefaultSettings()
            ]);
        }
    }


    public function downloadCV()
    {
        try {
            // Essayer de récupérer le nom du fichier depuis les settings
            $cv_file = 'abel_kpokouta_cv.pdf';
            
            if (class_exists('App\Models\PortfolioModel')) {
                $portfolioModel = new \App\Models\PortfolioModel();
                $settings = $portfolioModel->getSettings();
                $cv_file = $settings['cv_file'] ?? $cv_file;
            }
            
            $file_path = ROOTPATH . 'public/assets/cv/' . $cv_file;
            
            // Vérifier que le fichier existe
            if (!file_exists($file_path)) {
                throw new \Exception("Fichier CV non trouvé: " . $cv_file);
            }
            
            // Vérifier les permissions
            if (!is_readable($file_path)) {
                throw new \Exception("Permissions insuffisantes pour lire le fichier CV");
            }
            
            // Télécharger le fichier
            return $this->response->download($file_path, null);
            
        } catch (\Exception $e) {
            log_message('error', 'Erreur téléchargement CV: ' . $e->getMessage());
            
            // Rediriger vers la page contact avec un message d'erreur
            return redirect()->to('/contact')->with('error', 
                'Le CV n\'est pas disponible pour le moment. Veuillez me contacter directement.'
            );
        }
    }
    
    /**
     * Route de test pour vérifier le chargement des données (uniquement en développement)
     */
    public function testData()
    {
        if (ENVIRONMENT !== 'production') {
            // Activer temporairement l'affichage des erreurs pour le debug
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            
            echo "<div style='background: #f8f9fa; padding: 20px; margin: 10px; border-radius: 10px;'>";
            echo "<h3>🧪 TEST DES DONNÉES</h3>";
            
            if (class_exists('App\Models\PortfolioModel')) {
                $portfolioModel = new \App\Models\PortfolioModel();
                
                echo "<strong>Settings:</strong> " . count($portfolioModel->getSettings()) . " éléments<br>";
                echo "<strong>Projets featured:</strong> " . count($portfolioModel->getFeaturedProjects(6)) . " projets<br>";
                echo "<strong>Compétences:</strong> " . count($portfolioModel->getSkillsByCategory()) . " catégories<br>";
                echo "<strong>Expériences:</strong> " . count($portfolioModel->getExperiences()) . " expériences<br>";
                echo "<strong>Événements:</strong> " . count($portfolioModel->getFeaturedEvents(6)) . " événements<br>";
                
            } else {
                echo "❌ PortfolioModel non disponible";
            }
            
            echo "</div>";
            
            // Appeler la méthode index normale pour voir le résultat
            return $this->index();
        } else {
            return redirect()->to('/');
        }
    }

    public function test(){
        return view('index');
    }
}