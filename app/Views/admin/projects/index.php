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
                        <i class="fas fa-project-diagram me-2 text-primary"></i>Gestion des Projets
                    </h1>
                    <p class="text-muted mb-0">Créez et gérez vos projets portfolio</p>
                </div>
                <a href="<?= base_url('/admin/projets/creer') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Nouveau projet
                </a>
            </div>
        </div>
    </div>

    <!-- Messages flash -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Carte des projets -->
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-list me-1"></i>Liste des projets (<?= count($projects) ?>)
                </h6>
                <div class="d-flex">
                    <input type="text" class="form-control form-control-sm me-2" placeholder="Rechercher..." id="searchInput">
                    <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <?php if(!empty($projects)): ?>
                <div class="table-responsive">
                    <table class="table table-hover" id="projectsTable">
                        <thead class="table-light">
                            <tr>
                                <th>Titre</th>
                                <th>Technologies</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($projects as $project): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php if($project->image): ?>
                                            <img src="<?= base_url('/assets/images/projects/' . $project->image) ?>" 
                                                 alt="<?= esc($project->title) ?>" 
                                                 class="rounded me-3" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <strong><?= esc($project->title) ?></strong>
                                            <?php if($project->featured): ?>
                                                <span class="badge bg-warning ms-2">Vedette</span>
                                            <?php endif; ?>
                                            <br>
                                            <small class="text-muted"><?= esc(substr($project->description, 0, 60)) ?>...</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php 
                                        $techs = explode(',', $project->technologies);
                                        foreach(array_slice($techs, 0, 3) as $tech): 
                                            $tech = trim($tech);
                                        ?>
                                            <span class="badge bg-secondary"><?= esc($tech) ?></span>
                                        <?php endforeach; ?>
                                        <?php if(count($techs) > 3): ?>
                                            <span class="badge bg-light text-dark">+<?= count($techs) - 3 ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $project->status == 'active' ? 'success' : 'secondary' ?>">
                                        <?= $project->status == 'active' ? 'Actif' : 'Inactif' ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <?= date('d/m/Y', strtotime($project->created_at)) ?>
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('/project/' . $project->slug) ?>" 
                                           target="_blank" 
                                           class="btn btn-outline-primary" 
                                           title="Voir sur le site">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/projets/editer/' . $project->id) ?>" 
                                           class="btn btn-outline-warning" 
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                title="Supprimer"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal<?= $project->id ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Modal de suppression -->
                                    <div class="modal fade" id="deleteModal<?= $project->id ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Êtes-vous sûr de vouloir supprimer le projet <strong>"<?= esc($project->title) ?>"</strong> ?</p>
                                                    <p class="text-danger"><small>Cette action est irréversible.</small></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <a href="<?= base_url('/admin/projets/supprimer/' . $project->id) ?>" 
                                                       class="btn btn-danger">Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-project-diagram fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucun projet trouvé</h5>
                    <p class="text-muted">Commencez par créer votre premier projet.</p>
                    <a href="<?= base_url('/admin/projets/creer') ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Créer un projet
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Recherche en temps réel
document.getElementById('searchInput').addEventListener('input', function() {
    const searchText = this.value.toLowerCase();
    const rows = document.querySelectorAll('#projectsTable tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});

// Tri des colonnes
document.querySelectorAll('#projectsTable th').forEach(header => {
    header.style.cursor = 'pointer';
    header.addEventListener('click', function() {
        const table = this.closest('table');
        const columnIndex = Array.prototype.indexOf.call(this.parentElement.children, this);
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        
        rows.sort((a, b) => {
            const aText = a.children[columnIndex].textContent.trim();
            const bText = b.children[columnIndex].textContent.trim();
            return aText.localeCompare(bText);
        });
        
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
        rows.forEach(row => tbody.appendChild(row));
    });
});
</script>

<?php 
echo $this->include('admin/templates/footer'); 
?>