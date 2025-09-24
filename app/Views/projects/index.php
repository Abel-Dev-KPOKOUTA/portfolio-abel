<?php echo $this->include('templates/header'); ?>

<!-- Hero Section Projets -->
<section class="hero bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>Mes Projets</h1>
                <p class="lead">Découvrez l'ensemble de mes réalisations en développement, data science et cybersécurité</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fas fa-laptop-code" style="font-size: 8rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-5">
    <div class="container">
        <!-- Stats -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="d-flex flex-wrap justify-content-center gap-4">
                    <div class="stat-item">
                        <h3 class="text-primary mb-0"><?= count($projects ?? []) ?></h3>
                        <small>Projets réalisés</small>
                    </div>
                    <div class="stat-item">
                        <h3 class="text-primary mb-0">
                            <?= count(array_filter($projects ?? [], function($p) { 
                                return isset($p->featured) && $p->featured; 
                            })) ?>
                        </h3>
                        <small>Projets vedettes</small>
                    </div>
                    <div class="stat-item">
                        <h3 class="text-primary mb-0">6+</h3>
                        <small>Technologies maîtrisées</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="row g-4">
            <?php if(isset($projects) && !empty($projects)): ?>
                <?php foreach($projects as $project): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-custom h-100">
                        <!-- Project Image/Icon -->
                        <div class="project-image bg-gradient-primary text-white text-center py-4">
                            <?php 
                            $icon = 'code'; // Icône par défaut
                            if (isset($project->technologies)) {
                                $techs = strtolower($project->technologies);
                                if (strpos($techs, 'python') !== false) $icon = 'python';
                                elseif (strpos($techs, 'php') !== false) $icon = 'php';
                                elseif (strpos($techs, 'javascript') !== false) $icon = 'js';
                                elseif (strpos($techs, 'react') !== false) $icon = 'react';
                                elseif (strpos($techs, 'mobile') !== false) $icon = 'mobile-alt';
                                elseif (strpos($techs, 'data') !== false) $icon = 'chart-bar';
                                elseif (strpos($techs, 'machine learning') !== false) $icon = 'brain';
                            }
                            ?>
                            <i class="fab fa-<?= $icon ?> fa-3x"></i>
                        </div>
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title"><?= esc($project->title ?? 'Titre du projet') ?></h5>
                                <?php if(isset($project->featured) && $project->featured): ?>
                                    <span class="badge bg-warning">⭐ Vedette</span>
                                <?php endif; ?>
                            </div>
                            
                            <p class="card-text"><?= esc($project->description ?? 'Description du projet') ?></p>
                            
                            <!-- Technologies -->
                            <?php if(isset($project->technologies) && !empty($project->technologies)): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-1">Technologies utilisées :</small>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php 
                                    $techs = explode(',', $project->technologies);
                                    foreach(array_slice($techs, 0, 3) as $tech): 
                                        $tech = trim($tech);
                                    ?>
                                        <span class="badge bg-light text-dark"><?= esc($tech) ?></span>
                                    <?php endforeach; ?>
                                    <?php if(count($techs) > 3): ?>
                                        <span class="badge bg-light text-dark">+<?= count($techs) - 3 ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Dates -->
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    <?= isset($project->created_at) ? date('M Y', strtotime($project->created_at)) : 'Date non précisée' ?>
                                </small>
                            </div>
                            
                            <!-- Actions -->
                            <div class="d-flex gap-2">
                                <?php if(isset($project->github_url) && !empty($project->github_url) && $project->github_url != '#'): ?>
                                <a href="<?= esc($project->github_url) ?>" target="_blank" class="btn btn-outline-dark btn-sm" title="Voir le code">
                                    <i class="fab fa-github"></i>
                                </a>
                                <?php endif; ?>
                                
                                <?php if(isset($project->demo_url) && !empty($project->demo_url) && $project->demo_url != '#'): ?>
                                <a href="<?= esc($project->demo_url) ?>" target="_blank" class="btn btn-outline-primary btn-sm" title="Voir la démo">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <?php endif; ?>
                                
                                <?php if(isset($project->slug)): ?>
                                <a href="<?= base_url('/project/' . $project->slug) ?>" class="btn btn-primary btn-sm flex-fill">
                                    Voir les détails
                                </a>
                                <?php else: ?>
                                <span class="btn btn-secondary btn-sm flex-fill">Détails indisponibles</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun projet trouvé</h4>
                    <p class="text-muted">Mes projets seront bientôt disponibles ici.</p>
                    <a href="<?= base_url('/') ?>" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-1"></i>Retour à l'accueil
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2>Un projet en tête ?</h2>
        <p class="lead mb-4">Discutons de votre idée et voyons comment je peux vous aider à la concrétiser.</p>
        <a href="<?= base_url('/contact') ?>" class="btn btn-primary-custom btn-custom btn-lg">
            <i class="fas fa-paper-plane me-2"></i>Démarrer un projet
        </a>
    </div>
</section>

<style>
.hero {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
    padding: 6rem 0 4rem;
}

.project-image {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 15px 15px 0 0;
}

.stat-item {
    padding: 1rem 2rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    min-width: 150px;
}

.card-custom {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}
</style>

<?php echo $this->include('templates/footer'); ?>