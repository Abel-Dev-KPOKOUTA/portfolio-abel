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
                                $featured = $p['featured'] ?? $p->featured ?? false;
                                return $featured; 
                            })) ?>
                        </h3>
                        <small>Projets vedettes</small>
                    </div>
                    <div class="stat-item">
                        <h3 class="text-primary mb-0">
                            <?php 
                            $allTechs = [];
                            foreach($projects ?? [] as $project) {
                                $technologies = $project['technologies'] ?? $project->technologies ?? '';
                                if (!empty($technologies)) {
                                    $techs = explode(',', $technologies);
                                    $allTechs = array_merge($allTechs, array_map('trim', $techs));
                                }
                            }
                            echo count(array_unique($allTechs));
                            ?>
                        </h3>
                        <small>Technologies utilisées</small>
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
                        <!-- Project Header -->
                        <div class="card-header bg-transparent border-0 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <?php $isFeatured = $project['featured'] ?? $project->featured ?? false; ?>
                                <?php if($isFeatured): ?>
                                    <span class="badge bg-warning text-dark">⭐ Vedette</span>
                                <?php else: ?>
                                    <span></span>
                                <?php endif; ?>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    <?php 
                                    $createdAt = $project['created_at'] ?? $project->created_at ?? '';
                                    echo !empty($createdAt) ? date('M Y', strtotime($createdAt)) : 'Récent';
                                    ?>
                                </small>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <!-- Icône du projet -->
                            <div class="text-center mb-3">
                                <?php 
                                $icon = 'code';
                                $color = '#3b82f6';
                                $technologies = $project['technologies'] ?? $project->technologies ?? '';
                                
                                if (!empty($technologies)) {
                                    $techs = strtolower($technologies);
                                    if (strpos($techs, 'python') !== false) {
                                        $icon = 'python';
                                        $color = '#3776AB';
                                    } elseif (strpos($techs, 'php') !== false) {
                                        $icon = 'php';
                                        $color = '#777BB4';
                                    } elseif (strpos($techs, 'javascript') !== false || strpos($techs, 'js') !== false) {
                                        $icon = 'js';
                                        $color = '#F7DF1E';
                                    } elseif (strpos($techs, 'react') !== false) {
                                        $icon = 'react';
                                        $color = '#61DAFB';
                                    } elseif (strpos($techs, 'mobile') !== false) {
                                        $icon = 'mobile-alt';
                                        $color = '#FF6B6B';
                                    } elseif (strpos($techs, 'data') !== false || strpos($techs, 'analysis') !== false) {
                                        $icon = 'chart-bar';
                                        $color = '#10B981';
                                    } elseif (strpos($techs, 'machine learning') !== false || strpos($techs, 'ai') !== false) {
                                        $icon = 'brain';
                                        $color = '#8B5CF6';
                                    }
                                }
                                ?>
                                <i class="fab fa-<?= $icon ?> fa-3x mb-3" style="color: <?= $color ?>"></i>
                            </div>
                            
                            <h5 class="card-title text-center"><?= esc($project['title'] ?? $project->title ?? 'Titre du projet') ?></h5>
                            
                            <p class="card-text"><?= esc($project['description'] ?? $project->description ?? 'Description du projet') ?></p>
                            
                            <!-- Technologies -->
                            <?php if(!empty($technologies)): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Technologies utilisées :</small>
                                <div class="d-flex flex-wrap gap-1">
                                    <?php 
                                    $techs = explode(',', $technologies);
                                    foreach(array_slice($techs, 0, 4) as $tech): 
                                        $tech = trim($tech);
                                        if (!empty($tech)):
                                    ?>
                                        <span class="badge bg-light text-dark border small"><?= esc($tech) ?></span>
                                    <?php endif; endforeach; ?>
                                    <?php if(count($techs) > 4): ?>
                                        <span class="badge bg-secondary small">+<?= count($techs) - 4 ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Actions -->
                            <div class="d-flex gap-2 flex-wrap mt-auto">
                                <?php $githubUrl = $project['github_url'] ?? $project->github_url ?? ''; ?>
                                <?php if(!empty($githubUrl) && $githubUrl != '#'): ?>
                                <a href="<?= esc($githubUrl) ?>" target="_blank" class="btn btn-outline-dark btn-sm" title="Voir le code">
                                    <i class="fab fa-github"></i> Code
                                </a>
                                <?php endif; ?>
                                
                                <?php $demoUrl = $project['demo_url'] ?? $project->demo_url ?? ''; ?>
                                <?php if(!empty($demoUrl) && $demoUrl != '#'): ?>
                                <a href="<?= esc($demoUrl) ?>" target="_blank" class="btn btn-outline-primary btn-sm" title="Voir la démo">
                                    <i class="fas fa-external-link-alt"></i> Demo
                                </a>
                                <?php endif; ?>
                                
                                <?php $slug = $project['slug'] ?? $project->slug ?? ''; ?>
                                <?php if(!empty($slug)): ?>
                                <a href="<?= base_url('/project/' . $slug) ?>" class="btn btn-primary btn-sm flex-fill">
                                    <i class="fas fa-eye"></i> Détails
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
    background: linear-gradient(135deg, #3b82f6, #8b5cf6) !important;
    padding: 6rem 0 4rem;
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
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.btn-sm {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
}
</style>

<?php echo $this->include('templates/footer'); ?>