<?php namespace App\Controllers;

use CodeIgniter\Database\Database;

class RealDiagnostic extends BaseController
{
    public function index()
    {
        echo "<h1>🔍 DIAGNOSTIC RÉEL - CONTENU DE LA BASE</h1>";
        echo "<p>Cette page montre EXACTEMENT ce qui est dans la base de données</p>";
        
        try {
            $db = \Config\Database::connect();
            
            // 1. TEST DE CONNEXION
            echo "<h2 style='color: green;'>✅ Connexion base de données OK</h2>";
            echo "Base de données: <strong>" . $db->getDatabase() . "</strong><br>";
            
            // 2. LISTE DES TABLES
            echo "<h2>📋 Tables dans la base</h2>";
            $tables = $db->listTables();
            echo "<ul>";
            foreach($tables as $table) {
                echo "<li><strong>$table</strong></li>";
            }
            echo "</ul>";
            
            // 3. CONTENU RÉEL DE CHAQUE TABLE
            echo "<hr><h2>🗃️ CONTENU RÉEL DES TABLES</h2>";
            
            // Table PROJECTS
            echo "<h3>📊 Table PROJECTS</h3>";
            $projects = $db->table('projects')->get()->getResult();
            echo "Nombre d'enregistrements: <strong>" . count($projects) . "</strong><br>";
            
            if (!empty($projects)) {
                echo "<table border='1' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr style='background: #f0f0f0;'><th>ID</th><th>Titre</th><th>Description</th><th>Technologies</th><th>Featured</th><th>Status</th></tr>";
                foreach($projects as $project) {
                    echo "<tr>";
                    echo "<td>{$project->id}</td>";
                    echo "<td><strong>{$project->title}</strong></td>";
                    echo "<td>" . substr($project->description ?? 'N/A', 0, 100) . "...</td>";
                    echo "<td>{$project->technologies}</td>";
                    echo "<td>{$project->featured}</td>";
                    echo "<td>{$project->status}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red;'>❌ Table PROJECTS est VIDE</p>";
            }
            
            // Table SKILLS
            echo "<h3>💻 Table SKILLS</h3>";
            $skills = $db->table('skills')->get()->getResult();
            echo "Nombre d'enregistrements: <strong>" . count($skills) . "</strong><br>";
            
            if (!empty($skills)) {
                echo "<table border='1' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr style='background: #f0f0f0;'><th>ID</th><th>Nom</th><th>Catégorie</th><th>Niveau</th><th>Actif</th></tr>";
                foreach($skills as $skill) {
                    echo "<tr>";
                    echo "<td>{$skill->id}</td>";
                    echo "<td><strong>{$skill->name}</strong></td>";
                    echo "<td>{$skill->category}</td>";
                    echo "<td>{$skill->level}%</td>";
                    echo "<td>{$skill->is_active}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red;'>❌ Table SKILLS est VIDE</p>";
            }
            
            // Table EVENTS
            echo "<h3>🎯 Table EVENTS</h3>";
            $events = $db->table('events')->get()->getResult();
            echo "Nombre d'enregistrements: <strong>" . count($events) . "</strong><br>";
            
            if (!empty($events)) {
                echo "<table border='1' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr style='background: #f0f0f0;'><th>ID</th><th>Titre</th><th>Type</th><th>Date</th><th>Featured</th></tr>";
                foreach($events as $event) {
                    echo "<tr>";
                    echo "<td>{$event->id}</td>";
                    echo "<td><strong>{$event->title}</strong></td>";
                    echo "<td>{$event->type}</td>";
                    echo "<td>{$event->event_date}</td>";
                    echo "<td>{$event->is_featured}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red;'>❌ Table EVENTS est VIDE</p>";
            }
            
            // Table SETTINGS
            echo "<h3>⚙️ Table SETTINGS</h3>";
            $settings = $db->table('settings')->get()->getResult();
            echo "Nombre d'enregistrements: <strong>" . count($settings) . "</strong><br>";
            
            if (!empty($settings)) {
                echo "<table border='1' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr style='background: #f0f0f0;'><th>Clé</th><th>Valeur</th><th>Type</th></tr>";
                foreach($settings as $setting) {
                    echo "<tr>";
                    echo "<td><strong>{$setting->setting_key}</strong></td>";
                    echo "<td>{$setting->setting_value}</td>";
                    echo "<td>{$setting->setting_type}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red;'>❌ Table SETTINGS est VIDE</p>";
            }
            
            // 4. REQUÊTES SPÉCIFIQUES POUR LE SITE
            echo "<hr><h2>🔍 DONNÉES UTILISÉES PAR LE SITE</h2>";
            
            // Projets actifs et featured
            echo "<h3>Projets affichés sur la page d'accueil (featured + active)</h3>";
            $featuredProjects = $db->table('projects')
                ->where('featured', 1)
                ->where('status', 'active')
                ->get()
                ->getResult();
                
            echo "Nombre: <strong>" . count($featuredProjects) . "</strong><br>";
            foreach($featuredProjects as $proj) {
                echo "• {$proj->title} (ID: {$proj->id})<br>";
            }
            
            // Compétences actives
            echo "<h3>Compétences affichées (actives)</h3>";
            $activeSkills = $db->table('skills')
                ->where('is_active', 1)
                ->orderBy('display_order', 'ASC')
                ->get()
                ->getResult();
                
            echo "Nombre: <strong>" . count($activeSkills) . "</strong><br>";
            foreach($activeSkills as $skill) {
                echo "• {$skill->name} - {$skill->level}% (Catégorie: {$skill->category})<br>";
            }
            
        } catch (\Exception $e) {
            echo "<div style='color: red; background: #ffe6e6; padding: 15px; border-radius: 5px;'>";
            echo "<h3>❌ ERREUR CRITIQUE</h3>";
            echo "<strong>Message:</strong> " . $e->getMessage() . "<br>";
            echo "<strong>Fichier:</strong> " . $e->getFile() . "<br>";
            echo "<strong>Ligne:</strong> " . $e->getLine() . "<br>";
            echo "</div>";
        }
        
        echo "<hr>";
        echo "<div style='margin-top: 20px; padding: 15px; background: #e6f7ff; border-radius: 5px;'>";
        echo "<h3>🔗 Liens de test</h3>";
        echo "<a href='/'>🏠 Accueil</a> | ";
        echo "<a href='/projects'>💼 Page Projets</a> | ";
        echo "<a href='/contact'>📞 Page Contact</a>";
        echo "</div>";
    }
    
    public function testQueries()
    {
        echo "<h1>🧪 TEST DES REQUÊTES EXACTES</h1>";
        
        $db = \Config\Database::connect();
        
        // Requête EXACTE utilisée par PortfolioModel->getFeaturedProjects()
        echo "<h2>Requête pour getFeaturedProjects()</h2>";
        echo "<code>SELECT * FROM projects WHERE featured = 1 AND status = 'active' ORDER BY created_at DESC LIMIT 6</code><br><br>";
        
        $result = $db->query("SELECT * FROM projects WHERE featured = 1 AND status = 'active' ORDER BY created_at DESC LIMIT 6")->getResult();
        echo "Résultats: " . count($result) . "<br>";
        foreach($result as $row) {
            echo "• ID {$row->id}: {$row->title}<br>";
        }
        
        echo "<hr>";
        
        // Requête EXACTE pour les compétences
        echo "<h2>Requête pour getSkillsByCategory()</h2>";
        echo "<code>SELECT * FROM skills WHERE is_active = 1 ORDER BY display_order ASC</code><br><br>";
        
        $result = $db->query("SELECT * FROM skills WHERE is_active = 1 ORDER BY display_order ASC")->getResult();
        echo "Résultats: " . count($result) . "<br>";
        foreach($result as $row) {
            echo "• {$row->name} ({$row->category}) - {$row->level}%<br>";
        }
    }
}