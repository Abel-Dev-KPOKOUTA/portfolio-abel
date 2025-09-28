<?php
require_once '../app/Config/Constants.php';
require_once '../vendor/autoload.php';

use App\Models\MessageModel;

// Test direct de la base de données
echo "<h1>Test Contact Form</h1>";

try {
    $model = new MessageModel();
    
    $testData = [
        'name' => 'Test Direct',
        'email' => 'test@direct.com', 
        'subject' => 'Test Direct',
        'message' => 'Test message content',
        'ip_address' => '127.0.0.1',
        'user_agent' => 'Test',
        'is_read' => 0,
        'is_archived' => 0
    ];
    
    echo "<h3>Données test:</h3>";
    echo "<pre>" . print_r($testData, true) . "</pre>";
    
    if ($model->save($testData)) {
        $id = $model->getInsertID();
        echo "<h3 style='color: green;'>✅ SUCCÈS! ID: $id</h3>";
        
        // Vérifier
        $saved = $model->find($id);
        echo "<h3>Données sauvegardées:</h3>";
        echo "<pre>" . print_r($saved, true) . "</pre>";
    } else {
        echo "<h3 style='color: red;'>❌ ÉCHEC</h3>";
        echo "Erreurs: " . print_r($model->errors(), true);
    }
    
} catch (Exception $e) {
    echo "<h3 style='color: red;'>❌ EXCEPTION: " . $e->getMessage() . "</h3>";
}