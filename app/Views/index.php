<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abel Kpokouta - Portfolio | Étudiant en Génie Mathématique & Data Scientist</title>
    
    <!-- Meta tags pour SEO -->
    <meta name="description" content="Portfolio d'Abel Kpokouta, étudiant en Génie Mathématique et Modélisation, spécialisé en Data Science, développement web et cybersécurité.">
    <meta name="keywords" content="Abel Kpokouta, Data Science, Génie Mathématique, Python, Portfolio, Développeur">
    <meta name="author" content="Abel Kpokouta">
    
    <!-- Open Graph -->
    <meta property="og:title" content="Abel Kpokouta - Portfolio">
    <meta property="og:description" content="Portfolio d'Abel Kpokouta, étudiant en Génie Mathématique et Data Scientist">
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
        
        /* Navigation */
        .navbar {
            background: rgba(30, 58, 138, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            background: var(--primary-color) !important;
            box-shadow: 0 2px 30px rgba(0,0,0,0.2);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--accent-color) !important;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 8rem 0 6rem;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="%23ffffff03" points="0,1000 1000,0 1000,1000"/></svg>');
            opacity: 0.1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .hero .lead {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }
        
        /* Buttons */
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .btn-primary-custom {
            background: var(--accent-color);
            color: white;
        }
        
        .btn-primary-custom:hover {
            background: transparent;
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        .btn-outline-custom {
            background: transparent;
            border-color: white;
            color: white;
        }
        
        .btn-outline-custom:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        
        /* Cards */
        .card-custom {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        
        /* Skills */
        .skill-item {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
            transform: translateY(30px);
            opacity: 0;
        }
        
        .skill-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .skill-item i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }
        
        /* Projects */
        .project-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: white;
            height: 100%;
        }
        
        .project-card:hover {
            transform: scale(1.05);
        }
        
        .project-image {
            height: 200px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        
        .project-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.9), rgba(59, 130, 246, 0.9));
            color: white;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .project-card:hover .project-overlay {
            opacity: 1;
        }
        
        /* Sections */
        section {
            padding: 6rem 0;
        }
        
        .section-bg {
            background: var(--bg-light);
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .section-title .subtitle {
            font-size: 1.125rem;
            color: var(--text-light);
        }
        
        /* Footer */
        .footer {
            background: var(--primary-color);
            color: white;
            padding: 3rem 0 2rem;
        }
        
        .social-links a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        /* Contact Form */
        .form-control {
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--bg-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero {
                padding: 6rem 0 4rem;
            }
            
            section {
                padding: 4rem 0;
            }
        }
        
        /* Alert Styles */
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
        }
        
        /* ========================================= */
        /* EVENTS SECTION - DESIGN INNOVANT */
        /* ========================================= */
        
        #events {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            padding: 8rem 0;
            overflow: hidden;
        }
        
        .events-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255,255,255,0.05) 0%, transparent 50%),
                linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.02) 50%, transparent 70%);
            animation: backgroundPulse 10s ease-in-out infinite;
        }
        
        @keyframes backgroundPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .events-timeline {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 0;
        }
        
        .timeline-line {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, 
                transparent 0%, 
                rgba(255,255,255,0.3) 10%, 
                rgba(255,255,255,0.8) 50%, 
                rgba(255,255,255,0.3) 90%, 
                transparent 100%
            );
            transform: translateX(-50%);
            z-index: 1;
        }
        
        .event-item {
            position: relative;
            margin-bottom: 4rem;
            width: 100%;
            display: flex;
            align-items: center;
        }
        
        .event-item:nth-child(odd) {
            justify-content: flex-end;
        }
        
        .event-item:nth-child(even) {
            justify-content: flex-start;
        }
        
        .event-date {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
        
        .date-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10b981, #34d399);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
            border: 4px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
        }
        
        .date-circle .month {
            font-size: 0.8rem;
            line-height: 1;
        }
        
        .date-circle .year {
            font-size: 0.9rem;
            line-height: 1;
            opacity: 0.9;
        }
        
        .event-card {
            width: 45%;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .event-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 80px rgba(0,0,0,0.2);
        }
        
        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #3b82f6, #8b5cf6);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .event-card:hover::before {
            opacity: 1;
        }
        
        /* Types d'événements */
        .event-card.hackathon {
            border-left: 4px solid #ff6b6b;
        }
        
        .event-card.conference {
            border-left: 4px solid #4ecdc4;
        }
        
        .event-card.workshop {
            border-left: 4px solid #ffe66d;
        }
        
        .event-card.competition {
            border-left: 4px solid #a8e6cf;
        }
        
        .event-card.meetup {
            border-left: 4px solid #ff8b94;
        }
        
        .event-icon {
            position: absolute;
            top: -15px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .event-content {
            color: white;
        }
        
        .event-badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
        }
        
        .event-card h4 {
            color: white;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .event-description {
            color: rgba(255,255,255,0.9);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .event-tech {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .tech-badge {
            background: rgba(255,255,255,0.15);
            padding: 0.2rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            color: white;
            backdrop-filter: blur(5px);
        }
        
        .event-stats {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }
        
        .event-highlights {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .highlight {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
        }
        
        .event-feedback .rating {
            color: #ffd700;
        }
        
        .event-impact {
            background: rgba(16, 185, 129, 0.2);
            padding: 0.8rem;
            border-radius: 10px;
            margin-top: 1rem;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .event-reach {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .reach-stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.1);
            padding: 0.5rem 1rem;
            border-radius: 15px;
            font-size: 0.9rem;
        }
        
        .event-growth {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
            background: rgba(255,255,255,0.1);
            padding: 1rem;
            border-radius: 10px;
        }
        
        .growth-metric {
            text-align: center;
        }
        
        .growth-metric .number {
            display: block;
            font-size: 1.8rem;
            font-weight: bold;
            color: #10b981;
        }
        
        .growth-metric .label {
            font-size: 0.8rem;
            opacity: 0.9;
        }
        
        .growth-arrow {
            font-size: 1.5rem;
            color: #10b981;
            animation: bounceArrow 2s infinite;
        }
        
        @keyframes bounceArrow {
            0%, 100% { transform: translateX(0); }
            50% { transform: translateX(10px); }
        }
        
        /* Statistiques Section */
        .events-stats {
            margin-top: 6rem;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .stat-item {
            text-align: center;
            background: rgba(255,255,255,0.1);
            padding: 2rem;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.3s ease;
        }
        
        .stat-item:hover {
            transform: translateY(-10px);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: rgba(255,255,255,0.8);
            font-size: 1rem;
        }
        
        /* Navigation mise à jour */
        .navbar-nav .nav-link[href="#events"] {
            position: relative;
        }
        
        .navbar-nav .nav-link[href="#events"]:after {
            content: '🎯';
            margin-left: 5px;
            font-size: 0.8rem;
        }
        
        /* Responsive Events */
        @media (max-width: 768px) {
            .timeline-line {
                left: 30px;
            }
            
            .event-item {
                justify-content: flex-start !important;
                padding-left: 80px;
            }
            
            .event-card {
                width: 100%;
            }
            
            .event-date {
                left: 30px;
                transform: none;
            }
            
            .date-circle {
                width: 60px;
                height: 60px;
            }
            
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .stat-item {
                padding: 1.5rem 1rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
        }
        
        /* Animations spéciales pour les événements */
        @keyframes eventGlow {
            0%, 100% {
                box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            }
            50% {
                box-shadow: 0 25px 80px rgba(16, 185, 129, 0.2);
            }
        }
        
        .event-card:hover {
            animation: eventGlow 2s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <i class="fas fa-code"></i> Abel Kpokouta
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#skills">Compétences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Projets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#events">Événements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-up">
                        <h1>Abel Kpokouta</h1>
                        <p class="lead">Étudiant en Génie Mathématique & Modélisation | Data Scientist | Développeur Web</p>
                        <p class="mb-4">Passionné par la data science, la cybersécurité et le développement. Je construis des solutions innovantes qui allient mathématiques et technologie.</p>
                        
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#projects" class="btn btn-primary-custom btn-custom">
                                <i class="fas fa-laptop-code"></i> Mes Projets
                            </a>
                            <a href="#contact" class="btn btn-outline-custom btn-custom">
                                <i class="fas fa-envelope"></i> Me Contacter
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center" data-aos="fade-left">
                        <i class="fas fa-user-graduate" style="font-size: 15rem; opacity: 0.1;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-bg">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>À Propos</h2>
                <p class="subtitle">Découvrez mon parcours et mes ambitions</p>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <h3 class="mb-4">Mon Parcours</h3>
                    <p class="mb-4">
                        Actuellement étudiant en cycle d'ingénieur en Génie Mathématique et Modélisation au Bénin, 
                        je me spécialise dans la modélisation statistique appliquée à la finance et aux systèmes complexes.
                    </p>
                    <p class="mb-4">
                        Ma passion pour les mathématiques appliquées et la technologie m'a naturellement orienté vers 
                        la data science, domaine où je peux allier rigueur analytique et innovation technologique.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-graduation-cap text-primary me-3"></i>
                                <span>Génie Mathématique</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-chart-line text-primary me-3"></i>
                                <span>Data Science</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-shield-alt text-primary me-3"></i>
                                <span>Cybersécurité</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-piano text-primary me-3"></i>
                                <span>Musicien Pianiste</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card card-custom">
                        <div class="card-body p-4">
                            <h4 class="card-title mb-4">Mes Objectifs</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-target text-primary me-3"></i>
                                    Excellence académique (≥17/20)
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-brain text-primary me-3"></i>
                                    Développer des capacités d'analyse exceptionnelles
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-rocket text-primary me-3"></i>
                                    Devenir expert en Data Science & IA
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-globe text-primary me-3"></i>
                                    Maîtriser l'anglais technique
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-briefcase text-primary me-3"></i>
                                    Réussir en freelance
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Compétences</h2>
                <p class="subtitle">Technologies et outils que je maîtrise</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="skill-item">
                        <i class="fab fa-python"></i>
                        <h5>Python</h5>
                        <p>NumPy, Pandas, Matplotlib, Scikit-learn</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="skill-item">
                        <i class="fas fa-database"></i>
                        <h5>Bases de Données</h5>
                        <p>MySQL, SQL, Modélisation</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="skill-item">
                        <i class="fab fa-php"></i>
                        <h5>Développement Web</h5>
                        <p>PHP, CodeIgniter, HTML/CSS, JavaScript</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="skill-item">
                        <i class="fas fa-chart-bar"></i>
                        <h5>Data Science</h5>
                        <p>Machine Learning, Statistiques, Visualisation</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="skill-item">
                        <i class="fas fa-shield-alt"></i>
                        <h5>Cybersécurité</h5>
                        <p>Sécurité réseau, Cryptographie</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="skill-item">
                        <i class="fab fa-git-alt"></i>
                        <h5>Outils</h5>
                        <p>Git, GitHub, Linux, VS Code</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="skill-item">
                        <i class="fas fa-language"></i>
                        <h5>Langues</h5>
                        <p>Français (Natif), Anglais (En cours)</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="800">
                    <div class="skill-item">
                        <i class="fas fa-music"></i>
                        <h5>Créativité</h5>
                        <p>Piano, Composition musicale</p>
                    </div>
                </div>
            </div>
            
            <!-- CV Download -->
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="assets/cv/abel_kpokouta_cv.pdf" class="btn btn-primary-custom btn-custom" download>
                    <i class="fas fa-download"></i> Télécharger mon CV
                </a>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="section-bg">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Mes Projets</h2>
                <p class="subtitle">Découvrez mes réalisations techniques</p>
            </div>
            
            <div class="row g-4">
                <!-- Projet 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card card-custom h-100">
                        <div class="project-card">
                            <div class="project-image">
                                <i class="fas fa-virus"></i>
                            </div>
                            
                            <div class="project-overlay">
                                <h5 class="card-title">Analyse Prédictive COVID-19</h5>
                                <p class="card-text">Modèle de machine learning pour prédire l'évolution des cas de COVID-19 utilisant Python et les bibliothèques scientifiques.</p>
                                
                                <div class="mb-3">
                                    <small class="text-white-50">Technologies:</small><br>
                                    <small>Python, Pandas, NumPy, Matplotlib, Scikit-learn</small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fab fa-github"></i> Code
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Demo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">Analyse Prédictive COVID-19</h5>
                            <p class="card-text">Modèle de machine learning pour prédire l'évolution des cas de COVID-19 avec visualisations interactives et analyses statistiques avancées.</p>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary me-1">Python</span>
                                <span class="badge bg-secondary me-1">Pandas</span>
                                <span class="badge bg-secondary me-1">Scikit-learn</span>
                                <span class="badge bg-secondary me-1">Matplotlib</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Projet 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card card-custom h-100">
                        <div class="project-card">
                            <div class="project-image">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            
                            <div class="project-overlay">
                                <h5 class="card-title">Dashboard Finance</h5>
                                <p class="card-text">Application web Django pour le suivi en temps réel des marchés financiers avec graphiques dynamiques et alertes personnalisables.</p>
                                
                                <div class="mb-3">
                                    <small class="text-white-50">Technologies:</small><br>
                                    <small>Django, Python, Chart.js, Bootstrap, API</small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fab fa-github"></i> Code
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Demo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">Dashboard Finance</h5>
                            <p class="card-text">Plateforme de suivi financier en temps réel avec interface intuitive, graphiques interactifs et système d'alertes avancé.</p>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary me-1">Django</span>
                                <span class="badge bg-secondary me-1">Python</span>
                                <span class="badge bg-secondary me-1">Chart.js</span>
                                <span class="badge bg-secondary me-1">API</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Projet 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card card-custom h-100">
                        <div class="project-card">
                            <div class="project-image">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            
                            <div class="project-overlay">
                                <h5 class="card-title">Système Cybersécurité</h5>
                                <p class="card-text">Outil de détection d'intrusion utilisant des algorithmes de machine learning pour identifier les menaces réseau en temps réel.</p>
                                
                                <div class="mb-3">
                                    <small class="text-white-50">Technologies:</small><br>
                                    <small>Python, Scapy, TensorFlow, Flask, Network Security</small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fab fa-github"></i> Code
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Demo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">Système Cybersécurité</h5>
                            <p class="card-text">Solution de détection d'intrusion avancée combinant machine learning et analyse réseau pour une sécurité proactive.</p>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary me-1">Python</span>
                                <span class="badge bg-secondary me-1">TensorFlow</span>
                                <span class="badge bg-secondary me-1">Scapy</span>
                                <span class="badge bg-secondary me-1">Flask</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Projet 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card card-custom h-100">
                        <div class="project-card">
                            <div class="project-image">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            
                            <div class="project-overlay">
                                <h5 class="card-title">Portfolio Personnel</h5>
                                <p class="card-text">Site portfolio développé avec CodeIgniter, design responsive et interface d'administration. Optimisé pour le SEO et les performances.</p>
                                
                                <div class="mb-3">
                                    <small class="text-white-50">Technologies:</small><br>
                                    <small>PHP, CodeIgniter, MySQL, Bootstrap, JavaScript</small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fab fa-github"></i> Code
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Demo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">Portfolio Personnel</h5>
                            <p class="card-text">Site portfolio professionnel avec système de gestion de contenu, design moderne et optimisations techniques avancées.</p>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary me-1">PHP</span>
                                <span class="badge bg-secondary me-1">CodeIgniter</span>
                                <span class="badge bg-secondary me-1">MySQL</span>
                                <span class="badge bg-secondary me-1">Bootstrap</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Projet 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="card card-custom h-100">
                        <div class="project-card">
                            <div class="project-image">
                                <i class="fas fa-brain"></i>
                            </div>
                            
                            <div class="project-overlay">
                                <h5 class="card-title">IA - Reconnaissance Vocale</h5>
                                <p class="card-text">Système de reconnaissance vocale en français utilisant des réseaux de neurones profonds pour la transcription automatique.</p>
                                
                                <div class="mb-3">
                                    <small class="text-white-50">Technologies:</small><br>
                                    <small>Python, TensorFlow, Keras, Speech Recognition, NLP</small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fab fa-github"></i> Code
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Demo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">IA - Reconnaissance Vocale</h5>
                            <p class="card-text">Système intelligent de reconnaissance vocale avec traitement du langage naturel et apprentissage profond pour la transcription automatique.</p>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary me-1">Python</span>
                                <span class="badge bg-secondary me-1">TensorFlow</span>
                                <span class="badge bg-secondary me-1">Keras</span>
                                <span class="badge bg-secondary me-1">NLP</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Projet 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="card card-custom h-100">
                        <div class="project-card">
                            <div class="project-image">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            
                            <div class="project-overlay">
                                <h5 class="card-title">App Mobile - GestEtudiant</h5>
                                <p class="card-text">Application mobile de gestion d'emploi du temps et de notes pour étudiants avec synchronisation cloud et notifications.</p>
                                
                                <div class="mb-3">
                                    <small class="text-white-50">Technologies:</small><br>
                                    <small>Flutter, Dart, Firebase, REST API</small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fab fa-github"></i> Code
                                    </a>
                                    <a href="#" class="btn btn-outline-light btn-sm">
                                        <i class="fas fa-external-link-alt"></i> Demo
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">App Mobile - GestEtudiant</h5>
                            <p class="card-text">Application cross-platform pour la gestion académique avec interface intuitive et fonctionnalités de synchronisation avancées.</p>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary me-1">Flutter</span>
                                <span class="badge bg-secondary me-1">Dart</span>
                                <span class="badge bg-secondary me-1">Firebase</span>
                                <span class="badge bg-secondary me-1">API</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section - Innovation Design -->
    <section id="events" class="position-relative overflow-hidden">
        <!-- Background avec effet de parallax -->
        <div class="events-background"></div>
        
        <div class="container position-relative">
            <div class="section-title text-white" data-aos="fade-up">
                <h2>Événements & Participation</h2>
                <p class="subtitle text-white-75">Mon parcours dans la communauté tech</p>
            </div>
            
            <!-- Timeline Interactive -->
            <div class="events-timeline">
                <div class="timeline-line"></div>
                
                <!-- Hackathon 1 -->
                <div class="event-item" data-aos="fade-right" data-aos-delay="100">
                    <div class="event-date">
                        <div class="date-circle">
                            <span class="month">Nov</span>
                            <span class="year">2024</span>
                        </div>
                    </div>
                    <div class="event-card hackathon">
                        <div class="event-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="event-content">
                            <div class="event-badge">🏆 1ère Place</div>
                            <h4>Hackathon IA & Santé - Cotonou</h4>
                            <p class="event-description">
                                Développement d'une solution IA pour le diagnostic précoce de maladies tropicales. 
                                Notre équipe a créé un modèle de deep learning capable d'analyser des symptômes avec 94% de précision.
                            </p>
                            <div class="event-tech">
                                <span class="tech-badge">Python</span>
                                <span class="tech-badge">TensorFlow</span>
                                <span class="tech-badge">Flask</span>
                                <span class="tech-badge">React</span>
                            </div>
                            <div class="event-stats">
                                <div class="stat">
                                    <i class="fas fa-users"></i>
                                    <span>50+ participants</span>
                                </div>
                                <div class="stat">
                                    <i class="fas fa-clock"></i>
                                    <span>48h non-stop</span>
                                </div>
                                <div class="stat">
                                    <i class="fas fa-trophy"></i>
                                    <span>Prix Innovation</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Conférence -->
                <div class="event-item" data-aos="fade-left" data-aos-delay="200">
                    <div class="event-date">
                        <div class="date-circle">
                            <span class="month">Sep</span>
                            <span class="year">2024</span>
                        </div>
                    </div>
                    <div class="event-card conference">
                        <div class="event-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <div class="event-content">
                            <div class="event-badge">🎤 Speaker</div>
                            <h4>BeninTech Conference 2024</h4>
                            <p class="event-description">
                                Présentation sur "L'avenir de la Data Science en Afrique" devant 200+ professionnels. 
                                Discussion sur les opportunités et défis du machine learning dans le contexte africain.
                            </p>
                            <div class="event-highlights">
                                <div class="highlight">
                                    <i class="fas fa-video"></i>
                                    <span>Talk enregistré</span>
                                </div>
                                <div class="highlight">
                                    <i class="fas fa-eye"></i>
                                    <span>500+ vues</span>
                                </div>
                                <div class="highlight">
                                    <i class="fas fa-heart"></i>
                                    <span>Retours positifs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Workshop -->
                <div class="event-item" data-aos="fade-right" data-aos-delay="300">
                    <div class="event-date">
                        <div class="date-circle">
                            <span class="month">Juil</span>
                            <span class="year">2024</span>
                        </div>
                    </div>
                    <div class="event-card workshop">
                        <div class="event-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="event-content">
                            <div class="event-badge">👨‍🏫 Formateur</div>
                            <h4>Workshop Python pour Data Science</h4>
                            <p class="event-description">
                                Animation d'un atelier de 2 jours sur Python et les fondamentaux de la data science 
                                pour 30 étudiants débutants. Focus sur Pandas, Matplotlib et premiers modèles ML.
                            </p>
                            <div class="event-feedback">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span>4.9/5 (30 avis)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hackathon 2 -->
                <div class="event-item" data-aos="fade-left" data-aos-delay="400">
                    <div class="event-date">
                        <div class="date-circle">
                            <span class="month">Mai</span>
                            <span class="year">2024</span>
                        </div>
                    </div>
                    <div class="event-card hackathon">
                        <div class="event-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="event-content">
                            <div class="event-badge">🥉 3ème Place</div>
                            <h4>DevFest Bénin - Fintech Challenge</h4>
                            <p class="event-description">
                                Création d'une application de micro-crédit intelligent utilisant des algorithmes de 
                                scoring basés sur des données alternatives pour l'inclusion financière en Afrique.
                            </p>
                            <div class="event-tech">
                                <span class="tech-badge">Node.js</span>
                                <span class="tech-badge">MongoDB</span>
                                <span class="tech-badge">React Native</span>
                                <span class="tech-badge">ML</span>
                            </div>
                            <div class="event-impact">
                                <i class="fas fa-lightbulb"></i>
                                <span>Solution adoptée par une startup locale</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Competition -->
                <div class="event-item" data-aos="fade-right" data-aos-delay="500">
                    <div class="event-date">
                        <div class="date-circle">
                            <span class="month">Mar</span>
                            <span class="year">2024</span>
                        </div>
                    </div>
                    <div class="event-card competition">
                        <div class="event-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="event-content">
                            <div class="event-badge">🏅 Finaliste</div>
                            <h4>Google Solution Challenge 2024</h4>
                            <p class="event-description">
                                Participation au challenge mondial de Google avec une solution de monitoring 
                                environnemental utilisant l'IA et IoT pour la préservation des écosystèmes africains.
                            </p>
                            <div class="event-reach">
                                <div class="reach-stat">
                                    <i class="fas fa-globe"></i>
                                    <span>Compétition mondiale</span>
                                </div>
                                <div class="reach-stat">
                                    <i class="fas fa-users"></i>
                                    <span>5000+ participants</span>
                                </div>
                                <div class="reach-stat">
                                    <i class="fas fa-flag"></i>
                                    <span>Top 100 Global</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Meetup -->
                <div class="event-item" data-aos="fade-left" data-aos-delay="600">
                    <div class="event-date">
                        <div class="date-circle">
                            <span class="month">Jan</span>
                            <span class="year">2024</span>
                        </div>
                    </div>
                    <div class="event-card meetup">
                        <div class="event-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="event-content">
                            <div class="event-badge">🤝 Co-organisateur</div>
                            <h4>AI Meetup Cotonou - Premier Édition</h4>
                            <p class="event-description">
                                Co-fondation et organisation du premier meetup IA de Cotonou. Rassemblement mensuel 
                                de passionnés d'intelligence artificielle pour partager connaissances et projets.
                            </p>
                            <div class="event-growth">
                                <div class="growth-metric">
                                    <span class="number">50</span>
                                    <span class="label">Participants T1</span>
                                </div>
                                <div class="growth-arrow">→</div>
                                <div class="growth-metric">
                                    <span class="number">120</span>
                                    <span class="label">Membres actuels</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistiques Impressionnantes -->
            <div class="events-stats" data-aos="fade-up" data-aos-delay="700">
                <div class="stats-container">
                    <div class="stat-item">
                        <div class="stat-number" data-count="8">0</div>
                        <div class="stat-label">Événements Participés</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="300">0</div>
                        <div class="stat-label">Personnes Rencontrées</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="3">0</div>
                        <div class="stat-label">Prix Remportés</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="50">0</div>
                        <div class="stat-label">Étudiants Formés</div>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action Events -->
            <div class="text-center mt-5" data-aos="fade-up">
                <h3 class="text-white mb-4">Organiser un événement ensemble ?</h3>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="#contact" class="btn btn-outline-light btn-custom">
                        <i class="fas fa-handshake"></i> Collaboration
                    </a>
                    <a href="#contact" class="btn btn-outline-light btn-custom">
                        <i class="fas fa-microphone"></i> Invitation Speaker
                    </a>
                    <a href="#contact" class="btn btn-outline-light btn-custom">
                        <i class="fas fa-chalkboard-teacher"></i> Workshop
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-primary text-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="mb-4">Prêt à collaborer ?</h2>
                    <p class="lead mb-4">
                        Je suis disponible pour des projets freelance, des collaborations ou simplement 
                        pour discuter de vos idées. N'hésitez pas à me contacter !
                    </p>
                    <a href="#contact" class="btn btn-primary-custom btn-custom btn-lg">
                        <i class="fas fa-paper-plane"></i> Démarrer un projet
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p class="subtitle">Envoyez-moi un message</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-custom" data-aos="fade-up">
                        <div class="card-body p-5">
                            <form id="contactForm" class="contact-form">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="form-label">Nom complet *</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="subject" class="form-label">Sujet *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary-custom btn-custom btn-lg">
                                        <i class="fas fa-paper-plane"></i> Envoyer le message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="row mt-5">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center">
                        <div class="contact-icon mb-3">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <h5>Email</h5>
                        <p class="text-muted">abel.kpokouta@example.com</p>
                        <a href="mailto:abel.kpokouta@example.com" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-envelope"></i> Envoyer un email
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-center">
                        <div class="contact-icon mb-3">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <h5>Localisation</h5>
                        <p class="text-muted">Cotonou, Bénin</p>
                        <p class="text-muted"><i class="fas fa-clock"></i> GMT+1</p>
                    </div>
                </div>
                
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center">
                        <div class="contact-icon mb-3">
                            <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                        </div>
                        <h5>Statut</h5>
                        <p class="text-muted">Étudiant en Génie Math</p>
                        <p class="text-muted">Disponible pour missions freelance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <i class="fas fa-code me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h5 class="mb-0">Abel Kpokouta</h5>
                            <small class="text-white-50">Étudiant • Développeur • Data Scientist</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="text-lg-end">
                        <div class="social-links mb-3">
                            <a href="https://github.com/abel" target="_blank" title="GitHub">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="https://linkedin.com/in/abel-kpokouta" target="_blank" title="LinkedIn">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="mailto:abel.kpokouta@example.com" title="Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <a href="https://twitter.com/abel" target="_blank" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://instagram.com/abel.kpokouta" target="_blank" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                        <small class="text-white-50">
                            © 2025 Abel Kpokouta. Conçu avec ❤️ et beaucoup de café.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Contact form handling (simulation)
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
            submitBtn.disabled = true;
            
            // Simulate form submission
            setTimeout(() => {
                // Show success message
                const successMessage = document.createElement('div');
                successMessage.className = 'alert alert-success alert-custom mt-3';
                successMessage.innerHTML = '<i class="fas fa-check-circle me-2"></i>Message envoyé avec succès ! Je vous répondrai dans les plus brefs délais.';
                
                this.appendChild(successMessage);
                this.reset();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Remove success message after 5 seconds
                setTimeout(() => {
                    successMessage.remove();
                }, 5000);
                
            }, 2000);
        });

        // Add typing effect to hero section
        const heroTitle = document.querySelector('.hero h1');
        const originalTitle = heroTitle.textContent;
        let index = 0;

        function typeWriter() {
            if (index < originalTitle.length) {
                heroTitle.textContent = originalTitle.slice(0, index + 1);
                index++;
                setTimeout(typeWriter, 100);
            }
        }

        // Start typing effect after page load
        window.addEventListener('load', () => {
            heroTitle.textContent = '';
            setTimeout(typeWriter, 1000);
        });

        // Add counter animation for skills
        const skillItems = document.querySelectorAll('.skill-item');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.opacity = '1';
                }
            });
        });

        skillItems.forEach(item => {
            observer.observe(item);
        });

        // ========================================
        // ANIMATIONS ÉVÉNEMENTS - INNOVATION
        // ========================================
        
        // Animation des compteurs statistiques
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    counter.textContent = Math.floor(current);
                }, 16);
            });
        }

        // Observer pour les compteurs
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    counterObserver.unobserve(entry.target);
                }
            });
        });

        // Observer les statistiques
        const statsSection = document.querySelector('.events-stats');
        if (statsSection) {
            counterObserver.observe(statsSection);
        }

        // Animation des cartes d'événements
        const eventCards = document.querySelectorAll('.event-card');
        eventCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Animation de la timeline
        const timelineItems = document.querySelectorAll('.event-item');
        const timelineObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateX(0)';
                }
            });
        }, {
            threshold: 0.3
        });

        timelineItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transition = 'all 0.6s ease-out';
            timelineObserver.observe(item);
        });

        // Add particle effect to hero section
        function createParticle() {
            const particle = document.createElement('div');
            particle.style.cssText = `
                position: absolute;
                width: 4px;
                height: 4px;
                background: rgba(255,255,255,0.1);
                border-radius: 50%;
                pointer-events: none;
                animation: float 6s linear infinite;
            `;
            
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 6 + 's';
            
            document.querySelector('.hero').appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 6000);
        }

        // Create particles periodically
        setInterval(createParticle, 300);

        // Add CSS animation for particles
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0% {
                    transform: translateY(100vh) rotate(0deg);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100px) rotate(360deg);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Add scroll progress indicator
        const scrollProgress = document.createElement('div');
        scrollProgress.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
            z-index: 9999;
            transition: width 0.1s ease;
        `;
        document.body.appendChild(scrollProgress);

        window.addEventListener('scroll', () => {
            const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollTop = window.pageYOffset;
            const scrollPercent = (scrollTop / scrollHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });

        // Animation pour les cartes de projet
        const projectCards = document.querySelectorAll('.project-card');
        projectCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Console message for developers
        console.log(`
        👋 Salut ! Je vois que tu regardes le code source !
        
        🎯 Ce portfolio a été développé par Abel Kpokouta
        📧 Contact: abel.kpokouta@example.com
        💻 GitHub: https://github.com/abel
        
        N'hésite pas à me contacter si tu as des questions !
        `);

        // Initialisation des animations au chargement
        window.addEventListener('load', function() {
            // Ajouter une classe loaded au body pour les animations
            document.body.classList.add('loaded');
            
            // Animation d'entrée progressive
            setTimeout(() => {
                document.querySelector('.hero-content').style.opacity = '1';
                document.querySelector('.hero-content').style.transform = 'translateY(0)';
            }, 500);
        });

    </script>
</body>
</html>