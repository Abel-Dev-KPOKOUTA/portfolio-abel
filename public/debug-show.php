<?php
// Test ULTIME - Vérifier chaque étape
echo "<h1>Debug Show Page</h1>";

// 1. Vérifier si le fichier existe
$showPath = __DIR__ . '/../app/Views/admin/messages/show.php';
echo "<h2>1. Fichier show.php</h2>";
if (file_exists($showPath)) {
    echo "<p style='color: green;'>✅ EXISTE: $showPath</p>";
    
    // 2. Vérifier le contenu
    $content = file_get_contents($showPath);
    echo "<p>Contenu (" . strlen($content) . " caractères)</p>";
    
    // 3. Essayer de charger avec CodeIgniter
    echo "<h2>2. Test avec CodeIgniter</h2>";
    try {
        require_once __DIR__ . '/../vendor/autoload.php';
        
        // Simuler les données
        $data = [
            'message' => (object)[
                'id' => 1,
                'name' => 'Test Name',
                'email' => 'test@test.com', 
                'subject' => 'Test Subject',
                'message' => 'Test message content',
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'ip_address' => '127.0.0.1'
            ],
            'title' => 'Test',
            'settings' => []
        ];
        
        // Essayer de charger la vue
        $view = \Config\Services::renderer();
        $result = $view->setData($data)->render('admin/messages/show');
        echo "<p style='color: green;'>✅ VUE CHARGÉE AVEC SUCCÈS</p>";
        echo $result;
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ ERREUR: " . $e->getMessage() . "</p>";
        echo "<pre>Trace: " . $e->getTraceAsString() . "</pre>";
    }
} else {
    echo "<p style='color: red;'>❌ INTROUVABLE: $showPath</p>";
}