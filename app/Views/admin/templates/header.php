<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin - Abel Kpokouta') ?></title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 250px;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #2c3e50;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
        }
        
        .sidebar.collapsed {
            width: 70px;
        }
        
        .sidebar.collapsed + .main-content {
            margin-left: 70px;
        }
        
        .sidebar .nav-link {
            color: #bdc3c7;
            padding: 15px 20px;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #ecf0f1;
            background: #34495e;
            border-left-color: #3498db;
        }
        
        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }
        
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .sidebar .nav-link span {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header p-3 border-bottom">
            <a href="<?= base_url('/admin/dashboard') ?>" class="text-decoration-none">
                <h5 class="text-white mb-0">
                    <i class="fas fa-code me-2"></i>
                    <span class="sidebar-text">Admin Panel</span>
                </h5>
            </a>
        </div>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="<?= base_url('/admin/dashboard') ?>" 
                   class="nav-link <?= current_url() == base_url('/admin/dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="sidebar-text">Tableau de bord</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= base_url('/admin/projets') ?>" 
                   class="nav-link <?= strpos(current_url(), '/admin/projets') !== false ? 'active' : '' ?>">
                    <i class="fas fa-project-diagram"></i>
                    <span class="sidebar-text">Projets</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= base_url('/admin/messages') ?>" 
                   class="nav-link <?= strpos(current_url(), '/admin/messages') !== false ? 'active' : '' ?>">
                    <i class="fas fa-envelope"></i>
                    <span class="sidebar-text">Messages</span>
                    <?php if(isset($stats) && $stats['unread_messages'] > 0): ?>
                        <span class="badge bg-warning float-end"><?= $stats['unread_messages'] ?></span>
                    <?php endif; ?>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= base_url('/admin/parametres') ?>" 
                   class="nav-link <?= current_url() == base_url('/admin/parametres') ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span class="sidebar-text">Paramètres</span>
                </a>
            </li>
            
            <li class="nav-item mt-3">
                <a href="<?= base_url('/') ?>" target="_blank" class="nav-link">
                    <i class="fas fa-external-link-alt"></i>
                    <span class="sidebar-text">Voir le site</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= base_url('/admin/logout') ?>" class="nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="sidebar-text">Déconnexion</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main content -->
    <div class="main-content">
        <!-- Navbar top -->
        <nav class="navbar navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <button class="btn btn-sm btn-outline-secondary" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted small">
                        <i class="fas fa-user me-1"></i><?= session()->get('admin_username') ?>
                    </span>
                    <span class="badge bg-success">
                        <i class="fas fa-circle me-1"></i>En ligne
                    </span>
                </div>
            </div>
        </nav>

        <!-- Content will be inserted here -->