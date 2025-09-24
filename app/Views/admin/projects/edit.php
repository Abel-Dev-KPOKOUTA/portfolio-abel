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
                        <i class="fas fa-edit me-2 text-primary"></i>Modifier le Projet
                    </h1>
                    <p class="text-muted mb-0">Éditez les informations de "<?= esc($project->title) ?>"</p>
                </div>
                <a href="<?= base_url('/admin/projets') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <!-- Messages d'erreur -->
    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mb-0 mt-2">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit me-1"></i>Informations du projet
                    </h6>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="<?= base_url('/admin/projets/editer/' . $project->id) ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <!-- Titre -->
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label">Titre du projet *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?= old('title', $project->title) ?>" required maxlength="255">
                            </div>

                            <!-- Description courte -->
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description courte *</label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="3" required maxlength="500"><?= old('description', $project->description) ?></textarea>
                            </div>

                            <!-- Description complète -->
                            <div class="col-md-12 mb-3">
                                <label for="full_description" class="form-label">Description complète</label>
                                <textarea class="form-control" id="full_description" name="full_description" 
                                          rows="5"><?= old('full_description', $project->full_description ?? '') ?></textarea>
                            </div>

                            <!-- Technologies -->
                            <div class="col-md-12 mb-3">
                                <label for="technologies" class="form-label">Technologies utilisées *</label>
                                <input type="text" class="form-control" id="technologies" name="technologies" 
                                       value="<?= old('technologies', $project->technologies) ?>" required>
                            </div>

                            <!-- URLs -->
                            <div class="col-md-6 mb-3">
                                <label for="github_url" class="form-label">URL GitHub</label>
                                <input type="url" class="form-control" id="github_url" name="github_url" 
                                       value="<?= old('github_url', $project->github_url) ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="demo_url" class="form-label">URL Démo</label>
                                <input type="url" class="form-control" id="demo_url" name="demo_url" 
                                       value="<?= old('demo_url', $project->demo_url) ?>">
                            </div>

                            <!-- Image actuelle -->
                            <?php if($project->image): ?>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Image actuelle</label>
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url('/assets/images/projects/' . $project->image) ?>" 
                                         alt="<?= esc($project->title) ?>" 
                                         class="rounded me-3" 
                                         style="width: 100px; height: 75px; object-fit: cover;">
                                    <div>
                                        <small class="text-muted d-block"><?= $project->image ?></small>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                            <label class="form-check-label text-danger" for="remove_image">
                                                Supprimer cette image
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Nouvelle image -->
                            <div class="col-md-12 mb-3">
                                <label for="image" class="form-label"><?= $project->image ? 'Changer l\'image' : 'Image du projet' ?></label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>

                            <!-- Options -->
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                           <?= old('featured', $project->featured) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="featured">
                                        Mettre en vedette sur la page d'accueil
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Informations techniques -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border-info">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">
                                            <i class="fas fa-info-circle me-1"></i>Informations techniques
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <small class="text-muted">Slug :</small><br>
                                                <code><?= $project->slug ?></code>
                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">Créé le :</small><br>
                                                <?= date('d/m/Y H:i', strtotime($project->created_at)) ?>
                                            </div>
                                            <div class="col-md-4">
                                                <small class="text-muted">Modifié le :</small><br>
                                                <?= date('d/m/Y H:i', strtotime($project->updated_at)) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('/admin/projets') ?>" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </a>
                                    <div>
                                        <a href="<?= base_url('/project/' . $project->slug) ?>" 
                                           target="_blank" 
                                           class="btn btn-outline-primary me-2">
                                            <i class="fas fa-eye me-2"></i>Voir sur le site
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Aperçu en temps réel
function updatePreview() {
    const title = document.getElementById('title').value || '<?= esc($project->title) ?>';
    const description = document.getElementById('description').value || '<?= esc($project->description) ?>';
    const technologies = document.getElementById('technologies').value || '<?= esc($project->technologies) ?>';
    
    const preview = `
        <h5 class="text-primary">${title}</h5>
        <p class="mb-2">${description}</p>
        <div class="mb-2">
            <strong>Technologies :</strong> ${technologies}
        </div>
        <small class="text-muted">Aperçu après modification</small>
    `;
    
    document.getElementById('projectPreview').innerHTML = preview;
}

// Écouter les changements
document.getElementById('title').addEventListener('input', updatePreview);
document.getElementById('description').addEventListener('input', updatePreview);
document.getElementById('technologies').addEventListener('input', updatePreview);

// Initialiser l'aperçu si la div existe
if (document.getElementById('projectPreview')) {
    updatePreview();
}
</script>

<?php 
echo $this->include('admin/templates/footer'); 
?>