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
                        <i class="fas fa-plus-circle me-2 text-primary"></i>Nouveau Projet
                    </h1>
                    <p class="text-muted mb-0">Ajoutez un nouveau projet à votre portfolio</p>
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
                    <form method="POST" action="<?= base_url('/admin/projets/creer') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <!-- Titre -->
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label">Titre du projet *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?= old('title') ?>" required maxlength="255">
                                <div class="form-text">Titre court et descriptif</div>
                            </div>

                            <!-- Description courte -->
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description courte *</label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="3" required maxlength="500"><?= old('description') ?></textarea>
                                <div class="form-text">Description concise (max 500 caractères)</div>
                            </div>

                            <!-- Description complète -->
                            <div class="col-md-12 mb-3">
                                <label for="full_description" class="form-label">Description complète</label>
                                <textarea class="form-control" id="full_description" name="full_description" 
                                          rows="5"><?= old('full_description') ?></textarea>
                                <div class="form-text">Description détaillée du projet</div>
                            </div>

                            <!-- Technologies -->
                            <div class="col-md-12 mb-3">
                                <label for="technologies" class="form-label">Technologies utilisées *</label>
                                <input type="text" class="form-control" id="technologies" name="technologies" 
                                       value="<?= old('technologies') ?>" required>
                                <div class="form-text">Séparez les technologies par des virgules (ex: PHP, MySQL, JavaScript)</div>
                            </div>

                            <!-- URLs -->
                            <div class="col-md-6 mb-3">
                                <label for="github_url" class="form-label">URL GitHub</label>
                                <input type="url" class="form-control" id="github_url" name="github_url" 
                                       value="<?= old('github_url') ?>" placeholder="https://github.com/...">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="demo_url" class="form-label">URL Démo</label>
                                <input type="url" class="form-control" id="demo_url" name="demo_url" 
                                       value="<?= old('demo_url') ?>" placeholder="https://demo.com/...">
                            </div>

                            <!-- Image -->
                            <div class="col-md-12 mb-3">
                                <label for="image" class="form-label">Image du projet</label>
                                <input type="file" class="form-control" id="image" name="image" 
                                       accept="image/*">
                                <div class="form-text">Format recommandé : 800x600px, max 2MB</div>
                            </div>

                            <!-- Options -->
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                           <?= old('featured') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="featured">
                                        Mettre en vedette sur la page d'accueil
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Aperçu en temps réel -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border-primary">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">
                                            <i class="fas fa-eye me-1"></i>Aperçu du projet
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="projectPreview" class="text-muted">
                                            Remplissez le formulaire pour voir l'aperçu...
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
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Créer le projet
                                    </button>
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
    const title = document.getElementById('title').value || 'Titre du projet';
    const description = document.getElementById('description').value || 'Description courte...';
    const technologies = document.getElementById('technologies').value || 'Technologies';
    
    const preview = `
        <h5 class="text-primary">${title}</h5>
        <p class="mb-2">${description}</p>
        <div class="mb-2">
            <strong>Technologies :</strong> ${technologies}
        </div>
        <small class="text-muted">Ceci est un aperçu de l'affichage sur le site</small>
    `;
    
    document.getElementById('projectPreview').innerHTML = preview;
}

// Écouter les changements
document.getElementById('title').addEventListener('input', updatePreview);
document.getElementById('description').addEventListener('input', updatePreview);
document.getElementById('technologies').addEventListener('input', updatePreview);

// Initialiser l'aperçu
updatePreview();

// Validation du formulaire
document.querySelector('form').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const technologies = document.getElementById('technologies').value.trim();
    
    if (!title || !description || !technologies) {
        e.preventDefault();
        alert('Veuillez remplir les champs obligatoires (*)');
    }
});
</script>

<?php 
echo $this->include('admin/templates/footer'); 
?>