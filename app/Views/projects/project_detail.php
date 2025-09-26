<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Détail du projet' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <a href="<?= base_url('/projets') ?>" class="btn btn-outline-secondary mb-4">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux projets
                </a>
                
                <div class="card">
                    <?php if(!empty($project['image'])): ?>
                    <img src="<?= base_url('assets/images/projects/' . $project['image']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($project['title']) ?>"
                         style="max-height: 400px; object-fit: cover;">
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h1 class="card-title"><?= htmlspecialchars($project['title']) ?></h1>
                        
                        <?php if($project['featured']): ?>
                            <span class="badge bg-warning mb-3"><i class="fas fa-star me-1"></i>Projet vedette</span>
                        <?php endif; ?>
                        
                        <p class="lead"><?= htmlspecialchars($project['description']) ?></p>
                        
                        <?php if(!empty($project['full_description'])): ?>
                            <div class="mb-4">
                                <h3>Description complète</h3>
                                <p><?= nl2br(htmlspecialchars($project['full_description'])) ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mb-4">
                            <h4>Technologies utilisées</h4>
                            <div class="d-flex flex-wrap gap-2">
                                <?php 
                                $techs = explode(',', $project['technologies']);
                                foreach($techs as $tech): 
                                    $tech = trim($tech);
                                ?>
                                    <span class="badge bg-primary"><?= htmlspecialchars($tech) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <?php if(!empty($project['github_url'])): ?>
                            <div class="col-md-6">
                                <a href="<?= $project['github_url'] ?>" target="_blank" class="btn btn-dark w-100">
                                    <i class="fab fa-github me-2"></i>Voir sur GitHub
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <?php if(!empty($project['demo_url'])): ?>
                            <div class="col-md-6">
                                <a href="<?= $project['demo_url'] ?>" target="_blank" class="btn btn-primary w-100">
                                    <i class="fas fa-external-link-alt me-2"></i>Voir la démo
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="text-muted small">
                            <p>Projet créé le : <?= date('d/m/Y', strtotime($project['created_at'])) ?></p>
                            <?php if($project['created_at'] != $project['updated_at']): ?>
                                <p>Dernière modification : <?= date('d/m/Y', strtotime($project['updated_at'])) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>