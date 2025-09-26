<?php 
echo $this->include('admin/templates/header');
?>

<div class="container-fluid mt-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">
                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>Tableau de Bord
                    </h1>
                    <p class="text-muted mb-0">Bienvenue dans l'administration du portfolio</p>
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-success me-3">
                        <i class="fas fa-circle me-1"></i>Connecté
                    </span>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i><?= session()->get('admin_username') ?? 'Admin' ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('/') ?>" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>Voir le site
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('/admin/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Projets
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['total_projects'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Projets en vedette
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['featured_projects'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Messages non lus
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['unread_messages'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Messages
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $stats['total_messages'] ?? 0 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Derniers messages -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-envelope me-1"></i>Derniers messages
                        </h6>
                        <a href="<?= base_url('/admin/messages') ?>" class="btn btn-sm btn-outline-primary">
                            Voir tout
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if(!empty($recent_messages)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach($recent_messages as $message): ?>
                            <a href="<?= base_url('/admin/messages/' . $message->id) ?>" 
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= esc($message->name ?? 'Inconnu') ?></h6>
                                    <p class="mb-1 text-muted small"><?= esc($message->subject ?? 'Sans sujet') ?></p>
                                    <small class="text-muted">
                                        <?= date('d/m/Y H:i', strtotime($message->created_at)) ?>
                                    </small>
                                </div>
                                <?php if(!($message->is_read ?? false)): ?>
                                    <span class="badge bg-warning ms-2">Nouveau</span>
                                <?php endif; ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-3">Aucun message pour le moment</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Derniers projets -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-project-diagram me-1"></i>Derniers projets
                        </h6>
                        <a href="<?= base_url('/admin/projets') ?>" class="btn btn-sm btn-outline-primary">
                            Voir tout
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if(!empty($recent_projects)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach($recent_projects as $project): ?>
                            <a href="<?= base_url('/admin/projets/editer/' . ($project->id ?? '')) ?>" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><?= esc($project->title ?? 'Titre inconnu') ?></h6>
                                        <small class="text-muted">
                                            <?= date('d/m/Y', strtotime($project->created_at)) ?>
                                        </small>
                                    </div>
                                    <div>
                                        <?php if($project->featured ?? false): ?>
                                            <span class="badge bg-warning">Vedette</span>
                                        <?php endif; ?>
                                        <?php if(($project->status ?? 'active') === 'inactive'): ?>
                                            <span class="badge bg-secondary">Inactif</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-3">Aucun projet pour le moment</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-1"></i>Actions rapides
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('/admin/projets/creer') ?>" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-2"></i>Nouveau projet
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('/admin/messages') ?>" class="btn btn-success w-100">
                                <i class="fas fa-envelope me-2"></i>Voir messages
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('/admin/parametres') ?>" class="btn btn-info w-100">
                                <i class="fas fa-cog me-2"></i>Paramètres
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('/') ?>" target="_blank" class="btn btn-outline-dark w-100">
                                <i class="fas fa-eye me-2"></i>Voir le site
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
echo $this->include('admin/templates/footer');
?>