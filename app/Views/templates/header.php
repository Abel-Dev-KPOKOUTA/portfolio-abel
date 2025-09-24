<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Abel Kpokouta - Portfolio') ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= esc($settings['site_description'] ?? 'Portfolio d\'Abel Kpokouta, étudiant en Génie Mathématique et Data Scientist') ?>">
    <meta name="keywords" content="Abel Kpokouta, Data Science, Génie Mathématique, Python, Portfolio, Développeur">
    <meta name="author" content="Abel Kpokouta">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= esc($title ?? 'Abel Kpokouta - Portfolio') ?>">
    <meta property="og:description" content="<?= esc($settings['site_description'] ?? 'Portfolio d\'Abel Kpokouta') ?>">
    <meta property="og:type" content="website">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #10b981;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f8fafc;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        .navbar {
            background: rgba(30, 58, 138, 0.95) !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background: var(--primary-color) !important;
        }
        
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 8rem 0 6rem;
        }
        
        .card-custom {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        .skill-item {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom {
            background: var(--accent-color);
            color: white;
            border: 2px solid var(--accent-color);
        }
        
        .btn-primary-custom:hover {
            background: transparent;
            color: var(--accent-color);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?= $this->include('templates/nav') ?>
    
    <main>