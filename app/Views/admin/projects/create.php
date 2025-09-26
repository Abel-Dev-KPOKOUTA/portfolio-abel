<?php echo $this->include('admin/templates/header'); ?>

<div class="container-fluid mt-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">
                        <i class="fas fa-plus me-2 text-primary"></i>Nouveau Projet
                    </h1>
                    <p class="text-muted mb-0">Ajoutez un nouveau projet à votre portfolio</p>
                </div>
                <a href="<?= base_url('/admin/projets') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
            </div>
        </div>
    </div>

    <!-- Panneau de statut de validation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card" id="validationPanel">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">
                                <i class="fas fa-clipboard-check me-2"></i>Statut de validation
                            </h6>
                            <p class="mb-0 small text-muted" id="validationStatus">Remplissez les champs obligatoires</p>
                        </div>
                        <div id="validationBadge">
                            <span class="badge bg-warning">En attente</span>
                        </div>
                    </div>
                    <div class="mt-3" id="requirementsList"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages de succès -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Messages d'erreur généraux -->
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Messages de validation détaillés -->
    <?php if(isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mb-0 mt-2">
                <?php foreach($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-edit me-1"></i>Informations du projet
            </h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/admin/projets/creer') ?>" method="post" enctype="multipart/form-data" id="projectForm">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-8">
                        <!-- Titre -->
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Titre du projet <span class="text-danger">*</span>
                                <span class="requirement-status float-end" data-field="title"></span>
                            </label>
                            <input type="text" class="form-control <?= (isset($errors['title']) ? 'is-invalid' : '') ?>" 
                                   id="title" name="title" value="<?= old('title') ?>" 
                                   placeholder="Ex: Application de gestion de tâches" required>
                            <?php if(isset($errors['title'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['title'] ?>
                                </div>
                            <?php else: ?>
                                <div class="form-text">3 à 255 caractères requis</div>
                            <?php endif; ?>
                        </div>

                        <!-- Description courte -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Description courte <span class="text-danger">*</span>
                                <span class="requirement-status float-end" data-field="description"></span>
                            </label>
                            <textarea class="form-control <?= (isset($errors['description']) ? 'is-invalid' : '') ?>" 
                                      id="description" name="description" rows="3" maxlength="255" 
                                      required><?= old('description') ?></textarea>
                            <?php if(isset($errors['description'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['description'] ?>
                                </div>
                            <?php else: ?>
                                <div class="form-text">10 à 255 caractères requis</div>
                            <?php endif; ?>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <span id="descriptionCounter">0</span>/255 caractères
                                </small>
                            </div>
                        </div>

                        <!-- Description complète -->
                        <div class="mb-3">
                            <label for="full_description" class="form-label">
                                Description complète <span class="text-success">(Optionnel)</span>
                            </label>
                            <textarea class="form-control <?= (isset($errors['full_description']) ? 'is-invalid' : '') ?>" 
                                      id="full_description" name="full_description" rows="5"><?= old('full_description') ?></textarea>
                            <?php if(isset($errors['full_description'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['full_description'] ?>
                                </div>
                            <?php else: ?>
                                <div class="form-text">Description détaillée du projet</div>
                            <?php endif; ?>
                        </div>

                        <!-- Technologies -->
                        <div class="mb-3">
                            <label for="technologies" class="form-label">
                                Technologies utilisées <span class="text-danger">*</span>
                                <span class="requirement-status float-end" data-field="technologies"></span>
                            </label>
                            <input type="text" class="form-control <?= (isset($errors['technologies']) ? 'is-invalid' : '') ?>" 
                                   id="technologies" name="technologies" value="<?= old('technologies') ?>" 
                                   placeholder="Ex: PHP, MySQL, JavaScript, Bootstrap" required>
                            <?php if(isset($errors['technologies'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['technologies'] ?>
                                </div>
                            <?php else: ?>
                                <div class="form-text">Séparez les technologies par des virgules</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                Image du projet <span class="text-success">(Optionnel)</span>
                            </label>
                            <input type="file" class="form-control <?= (isset($errors['image']) ? 'is-invalid' : '') ?>" 
                                   id="image" name="image" accept="image/*">
                            <?php if(isset($errors['image'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['image'] ?>
                                </div>
                            <?php else: ?>
                                <div class="form-text">JPG, PNG (max 2MB)</div>
                            <?php endif; ?>
                            <div class="mt-2" id="imagePreview"></div>
                        </div>

                        <!-- URLs -->
                        <div class="mb-3">
                            <label for="github_url" class="form-label">
                                URL GitHub <span class="text-success">(Optionnel)</span>
                            </label>
                            <input type="url" class="form-control <?= (isset($errors['github_url']) ? 'is-invalid' : '') ?>" 
                                   id="github_url" name="github_url" value="<?= old('github_url') ?>" 
                                   placeholder="https://github.com/username/project">
                            <?php if(isset($errors['github_url'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['github_url'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="demo_url" class="form-label">
                                URL Démo <span class="text-success">(Optionnel)</span>
                            </label>
                            <input type="url" class="form-control <?= (isset($errors['demo_url']) ? 'is-invalid' : '') ?>" 
                                   id="demo_url" name="demo_url" value="<?= old('demo_url') ?>" 
                                   placeholder="https://demo.com/project">
                            <?php if(isset($errors['demo_url'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['demo_url'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Options -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                       <?= old('featured') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="featured">
                                    <i class="fas fa-star me-1 text-warning"></i>Projet en vedette <span class="text-success">(Optionnel)</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="active"
                                       <?= old('status', 'active') === 'active' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="status">
                                    <i class="fas fa-power-off me-1 text-success"></i>Projet actif <span class="text-success">(Optionnel)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Aperçu en temps réel -->
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title"><i class="fas fa-eye me-1"></i>Aperçu</h6>
                                <p class="small mb-1"><strong id="previewTitle">Titre du projet</strong></p>
                                <p class="small text-muted mb-1" id="previewDescription">Description courte...</p>
                                <div id="previewTechnologies"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="<?= base_url('/admin/projets') ?>" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                        <i class="fas fa-save me-2"></i>Créer le projet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la création</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir créer ce projet ?</p>
                <div class="alert alert-info">
                    <strong>Récapitulatif :</strong>
                    <div id="confirmationSummary"></div>
                </div>
                <div class="alert alert-warning" id="missingFieldsAlert" style="display: none;">
                    <strong>Champs manquants :</strong>
                    <ul id="missingFieldsList"></ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Modifier</button>
                <button type="button" class="btn btn-primary" id="confirmCreate">Confirmer la création</button>
            </div>
        </div>
    </div>
</div>

<script>
// Configuration des exigences
const requirements = {
    title: { min: 3, max: 255, required: true },
    description: { min: 10, max: 255, required: true },
    technologies: { min: 1, required: true }
};

// VERSION SIMPLIFIÉE ET FONCTIONNELLE
document.addEventListener('DOMContentLoaded', function() {
    // Compteur de caractères
    const descriptionEl = document.getElementById('description');
    document.getElementById('descriptionCounter').textContent = descriptionEl.value.length;
    
    descriptionEl.addEventListener('input', function() {
        document.getElementById('descriptionCounter').textContent = this.value.length;
        validateForm();
    });
    
    // Validation en temps réel
    ['title', 'description', 'technologies'].forEach(field => {
        document.getElementById(field).addEventListener('input', validateForm);
    });
    
    // Aperçu en temps réel
    function updatePreview() {
        document.getElementById('previewTitle').textContent = 
            document.getElementById('title').value || 'Titre du projet';
        document.getElementById('previewDescription').textContent = 
            document.getElementById('description').value || 'Description courte...';
        
        const technologies = document.getElementById('technologies').value;
        const previewTech = document.getElementById('previewTechnologies');
        
        if (technologies) {
            const techs = technologies.split(',').map(tech => tech.trim());
            previewTech.innerHTML = techs.map(tech => 
                `<span class="badge bg-secondary me-1 small">${tech}</span>`
            ).join('');
        } else {
            previewTech.innerHTML = '<span class="badge bg-light text-dark small">Aucune technologie</span>';
        }
    }
    
    ['title', 'description', 'technologies'].forEach(field => {
        document.getElementById(field).addEventListener('input', updatePreview);
    });
    
    // Validation simple
    function validateForm() {
        const title = document.getElementById('title').value.trim();
        const description = document.getElementById('description').value.trim();
        const technologies = document.getElementById('technologies').value.trim();
        
        const isValid = title.length >= 3 && 
                       description.length >= 10 && 
                       technologies.length >= 1;
        
        document.getElementById('submitBtn').disabled = !isValid;
        
        // Mise à jour du panneau de statut
        updateValidationPanel(isValid, {
            title: title.length >= 3,
            description: description.length >= 10,
            technologies: technologies.length >= 1
        });
        
        return isValid;
    }
    
    // Mise à jour du panneau de validation (version simplifiée)
    function updateValidationPanel(isValid, fieldStatus) {
        const panel = document.getElementById('validationPanel');
        const status = document.getElementById('validationStatus');
        const badge = document.getElementById('validationBadge');
        
        if (isValid) {
            panel.className = 'card border-success';
            status.innerHTML = '<strong>Formulaire valide !</strong> Vous pouvez créer le projet.';
            badge.innerHTML = '<span class="badge bg-success">Prêt</span>';
            document.getElementById('submitBtn').disabled = false;
        } else {
            panel.className = 'card border-warning';
            status.innerHTML = '<strong>Champs requis manquants :</strong> Complétez les informations obligatoires.';
            badge.innerHTML = '<span class="badge bg-warning">Incomplet</span>';
            document.getElementById('submitBtn').disabled = true;
        }
    }
    
    // Aperçu de l'image
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail mt-2" style="max-height: 150px;">`;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // SUPPRIMEZ TOUTE LA CONFIRMATION COMPLEXE
    // Le formulaire se soumettra normalement quand le bouton est cliqué
    
    // Initialisation
    validateForm();
    updatePreview();
});
</script>

<?php echo $this->include('admin/templates/footer'); ?>




