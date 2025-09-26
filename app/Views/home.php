<?php 
// CodeIgniter 4 utilise include() au lieu de extend()
echo $this->include('templates/header'); 
?>

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div data-aos="fade-up">
                    <h1>Abel Kpokouta</h1>
                    <p class="lead">Étudiant en Génie Mathématique & Modélisation | Data Scientist | Développeur Web</p>
                    <p class="mb-4">Passionné par la data science, la cybersécurité et le développement. Je construis des solutions innovantes qui allient mathématiques et technologie.</p>
                    
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#projects" class="btn btn-primary-custom btn-custom">
                            <i class="fas fa-laptop-code"></i> Mes Projets
                        </a>
                        <a href="<?= base_url('/contact') ?>" class="btn btn-outline-light btn-custom">
                            <i class="fas fa-envelope"></i> Me Contacter
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left">
                <i class="fas fa-user-graduate" style="font-size: 15rem; opacity: 0.1;"></i>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>À Propos</h2>
            <p class="lead">Découvrez mon parcours et mes ambitions</p>
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

<!-- Experiences Section -->
<section id="experiences" class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>Mon Parcours Professionnel</h2>
            <p class="lead">Expériences académiques et professionnelles</p>
        </div>
        
        <div class="row">
            <?php if(isset($experiences) && !empty($experiences)): ?>
                <div class="col-lg-10 mx-auto">
                    <div class="timeline">
                        <?php foreach($experiences as $index => $exp): ?>
                        <div class="timeline-item" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                            <div class="timeline-content">
                                <?php 
                                $title = $exp['title'] ?? $exp->title ?? 'Titre non spécifié';
                                $type = $exp['type'] ?? $exp->type ?? 'expérience';
                                $company = $exp['company'] ?? $exp->company ?? 'Organisation non spécifiée';
                                $location = $exp['location'] ?? $exp->location ?? '';
                                $startDate = $exp['start_date'] ?? $exp->start_date ?? '';
                                $endDate = $exp['end_date'] ?? $exp->end_date ?? '';
                                $currentJob = $exp['current_job'] ?? $exp->current_job ?? false;
                                $description = $exp['description'] ?? $exp->description ?? '';
                                $technologies = $exp['technologies'] ?? $exp->technologies ?? '';
                                ?>
                                
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="mb-0"><?= esc($title) ?></h5>
                                    <span class="badge bg-primary"><?= esc(ucfirst($type)) ?></span>
                                </div>
                                
                                <h6 class="text-primary mb-2">
                                    <i class="fas fa-building me-2"></i><?= esc($company) ?>
                                    <?php if(!empty($location)): ?>
                                        <small class="text-muted"> - <?= esc($location) ?></small>
                                    <?php endif; ?>
                                </h6>
                                
                                <div class="timeline-period mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        <?= !empty($startDate) ? date('M Y', strtotime($startDate)) : 'Date de début' ?>
                                        - 
                                        <?= $currentJob ? 
                                            '<span class="text-success">En cours</span>' : 
                                            (!empty($endDate) ? date('M Y', strtotime($endDate)) : 'Date de fin') 
                                        ?>
                                    </small>
                                </div>
                                
                                <?php if(!empty($description)): ?>
                                    <p class="mb-3"><?= esc($description) ?></p>
                                <?php endif; ?>
                                
                                <?php if(!empty($technologies)): ?>
                                    <div class="technologies-tags">
                                        <small class="text-muted d-block mb-2">Technologies utilisées :</small>
                                        <div class="d-flex flex-wrap gap-1">
                                            <?php 
                                            $techs = explode(',', $technologies);
                                            foreach($techs as $tech): 
                                                $tech = trim($tech);
                                                if (!empty($tech)):
                                            ?>
                                                <span class="badge bg-light text-dark border"><?= esc($tech) ?></span>
                                            <?php endif; endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="card card-custom">
                        <div class="card-body py-5">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Expériences en cours de chargement...</h5>
                            <p class="text-muted">Mon parcours professionnel sera bientôt disponible ici.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Call to Action pour les expériences -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= base_url('/contact') ?>" class="btn btn-outline-primary btn-custom">
                <i class="fas fa-handshake me-2"></i>Discutons de collaborations
            </a>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>Compétences Techniques</h2>
            <p class="lead">Technologies et outils que je maîtrise</p>
        </div>
        
        <!-- Compétences par catégorie -->
        <?php if(isset($skills) && !empty($skills)): ?>
            <?php foreach($skills as $category => $categorySkills): ?>
                <?php if(!empty($categorySkills)): ?>
                <div class="category-section mb-5" data-aos="fade-up">
                    <h4 class="category-title mb-4 text-center">
                        <i class="fas fa-<?= $this->getCategoryIcon($category) ?> me-2"></i>
                        <?= esc(ucfirst(str_replace('_', ' ', $category))) ?>
                    </h4>
                    <div class="row g-4">
                        <?php foreach($categorySkills as $index => $skill): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="skill-item text-center" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                                <?php 
                                $icon = $skill['icon'] ?? $skill->icon ?? 'code';
                                $color = $skill['color'] ?? $skill->color ?? '#3b82f6';
                                $name = $skill['name'] ?? $skill->name ?? 'Compétence';
                                $level = $skill['level'] ?? $skill->level ?? 0;
                                ?>
                                
                                <?php if(!empty($icon)): ?>
                                    <i class="<?= esc($icon) ?> fa-3x mb-3" style="color: <?= esc($color) ?>"></i>
                                <?php else: ?>
                                    <i class="fas fa-code fa-3x mb-3 text-primary"></i>
                                <?php endif; ?>
                                
                                <h6 class="skill-name"><?= esc($name) ?></h6>
                                
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: <?= $level ?>%; background-color: <?= esc($color) ?>"
                                         aria-valuenow="<?= $level ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                    </div>
                                </div>
                                
                                <small class="skill-level" style="color: <?= esc($color) ?>">
                                    <strong><?= $level ?>%</strong>
                                </small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="card card-custom">
                    <div class="card-body py-5">
                        <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Compétences en cours de chargement...</h5>
                        <p class="text-muted">Mes compétences techniques seront bientôt affichées ici.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- CV Download -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= base_url('/download-cv') ?>" class="btn btn-primary-custom btn-custom">
                <i class="fas fa-download me-2"></i> Télécharger mon CV complet
            </a>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>Mes Réalisations</h2>
            <p class="lead">Découvrez mes projets techniques et contributions</p>
        </div>
        
        <div class="row g-4">
            <?php if(isset($projects) && !empty($projects)): ?>
                <?php foreach($projects as $index => $project): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                    <div class="card card-custom h-100 project-card">
                        <div class="card-body d-flex flex-column">
                            <div class="project-header mb-3">
                                <?php $isFeatured = $project['featured'] ?? $project->featured ?? false; ?>
                                <?php if($isFeatured): ?>
                                    <span class="badge bg-warning text-dark featured-badge">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <h5 class="card-title"><?= esc($project['title'] ?? $project->title ?? 'Titre du projet') ?></h5>
                            <p class="card-text flex-grow-1"><?= esc($project['description'] ?? $project->description ?? 'Description du projet') ?></p>
                            
                            <?php $technologies = $project['technologies'] ?? $project->technologies ?? ''; ?>
                            <?php if(!empty($technologies)): ?>
                            <div class="technologies mb-3">
                                <?php 
                                $techs = explode(',', $technologies);
                                foreach(array_slice($techs, 0, 4) as $tech): 
                                    $tech = trim($tech);
                                    if (!empty($tech)):
                                ?>
                                    <span class="badge bg-secondary me-1 mb-1"><?= esc($tech) ?></span>
                                <?php endif; endforeach; ?>
                                <?php if(count($techs) > 4): ?>
                                    <span class="badge bg-light text-dark">+<?= count($techs) - 4 ?> plus</span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="project-actions mt-auto">
                                <div class="d-flex gap-2 flex-wrap">
                                    <?php $githubUrl = $project['github_url'] ?? $project->github_url ?? ''; ?>
                                    <?php if(!empty($githubUrl) && $githubUrl != '#'): ?>
                                    <a href="<?= esc($githubUrl) ?>" target="_blank" class="btn btn-outline-dark btn-sm mb-1">
                                        <i class="fab fa-github"></i> Code
                                    </a>
                                    <?php endif; ?>
                                    
                                    <?php $demoUrl = $project['demo_url'] ?? $project->demo_url ?? ''; ?>
                                    <?php if(!empty($demoUrl) && $demoUrl != '#'): ?>
                                    <a href="<?= esc($demoUrl) ?>" target="_blank" class="btn btn-outline-primary btn-sm mb-1">
                                        <i class="fas fa-external-link-alt"></i> Demo
                                    </a>
                                    <?php endif; ?>
                                    
                                    <?php $slug = $project['slug'] ?? $project->slug ?? ''; ?>
                                    <?php if(!empty($slug)): ?>
                                    <a href="<?= base_url('/project/' . $slug) ?>" class="btn btn-primary btn-sm mb-1">
                                        <i class="fas fa-eye"></i> Détails
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="card card-custom">
                        <div class="card-body py-5">
                            <i class="fas fa-laptop-code fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Projets en cours de chargement...</h5>
                            <p class="text-muted">Mes réalisations techniques seront bientôt affichées ici.</p>
                            <a href="<?= base_url('/projects') ?>" class="btn btn-outline-primary mt-3">
                                Voir tous les projets <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if(isset($projects) && !empty($projects)): ?>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="<?= base_url('/projects') ?>" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-folder-open me-2"></i> Explorer tous mes projets
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Events Section -->
<?php if(isset($events) && !empty($events)): ?>
<section id="events" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2>Événements & Participations</h2>
            <p class="lead">Mon engagement dans la communauté tech</p>
        </div>
        
        <div class="row g-4">
            <?php foreach($events as $index => $event): ?>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                <div class="card card-custom h-100">
                    <div class="card-body">
                        <?php 
                        $eventType = $event['type'] ?? $event->type ?? 'événement';
                        $eventResult = $event['result'] ?? $event->result ?? '';
                        $eventTitle = $event['title'] ?? $event->title ?? 'Événement';
                        $eventDescription = $event['description'] ?? $event->description ?? 'Description de l\'événement';
                        $eventLocation = $event['location'] ?? $event->location ?? 'En ligne';
                        $eventDate = $event['event_date'] ?? $event->event_date ?? '';
                        $eventRole = $event['role'] ?? $event->role ?? '';
                        $eventProjectLink = $event['project_link'] ?? $event->project_link ?? '';
                        ?>
                        
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary">
                                <?= esc(ucfirst(str_replace('_', ' ', $eventType))) ?>
                            </span>
                            <?php if(!empty($eventResult)): ?>
                                <span class="badge bg-success"><?= esc($eventResult) ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <h5 class="card-title"><?= esc($eventTitle) ?></h5>
                        <p class="card-text"><?= esc($eventDescription) ?></p>
                        
                        <div class="event-meta">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i> 
                                <?= esc($eventLocation) ?>
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i> 
                                <?= !empty($eventDate) ? date('d/m/Y', strtotime($eventDate)) : 'Date non précisée' ?>
                            </small>
                            <?php if(!empty($eventRole)): ?>
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i> 
                                    Rôle: <?= esc($eventRole) ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        
                        <?php if(!empty($eventProjectLink)): ?>
                        <div class="mt-3">
                            <a href="<?= esc($eventProjectLink) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> Voir le projet
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contact CTA -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2>Prêt à collaborer sur un projet ?</h2>
        <p class="lead mb-4">Discutons de vos idées et voyons comment je peux vous aider</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="<?= base_url('/contact') ?>" class="btn btn-light btn-lg">
                <i class="fas fa-paper-plane me-2"></i> Me Contacter
            </a>
            <a href="<?= base_url('/download-cv') ?>" class="btn btn-outline-light btn-lg">
                <i class="fas fa-download me-2"></i> Télécharger mon CV
            </a>
        </div>
    </div>
</section>

<?php 
// CodeIgniter 4 utilise include() pour le footer
echo $this->include('templates/footer'); 
?>

<style>
/* Styles pour la timeline des expériences */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
}

.timeline-item {
    position: relative;
    margin-bottom: 40px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -23px;
    top: 10px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #3b82f6;
    border: 3px solid white;
    box-shadow: 0 0 0 3px #3b82f6;
    z-index: 2;
}

.timeline-content {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    border-left: 4px solid #3b82f6;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.timeline-content:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 35px rgba(0,0,0,0.15);
}

.timeline-period {
    background: #f8f9fa;
    padding: 5px 10px;
    border-radius: 5px;
    display: inline-block;
}

/* Styles pour les cartes de projets */
.project-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.featured-badge {
    position: absolute;
    top: 10px;
    right: 10px;
}

.category-title {
    color: #3b82f6;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
}

.skill-item {
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease;
}

.skill-item:hover {
    transform: translateY(-3px);
}

/* Responsive */
@media (max-width: 768px) {
    .timeline {
        padding-left: 20px;
    }
    
    .timeline-item::before {
        left: -18px;
        width: 12px;
        height: 12px;
    }
    
    .timeline-content {
        padding: 20px;
    }
    
    .btn-sm {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
}
</style>

<script>
// Animation au scroll
document.addEventListener('DOMContentLoaded', function() {
    // Animation pour la timeline
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateX(0)';
            }
        });
    }, { threshold: 0.1 });
    
    timelineItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-30px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(item);
    });
});
</script>