<?php echo $this->include('admin/templates/header'); ?>

<div class="container-fluid mt-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0">
                        <i class="fas fa-edit me-2 text-primary"></i>Modifier le Projet
                    </h1>
                    <p class="text-muted mb-0">Modifiez les informations de votre projet</p>
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
                            <p class="mb-0 small text-muted" id="validationStatus">Modifiez les champs si nécessaire</p>
                        </div>
                        <div id="validationBadge">
                            <span class="badge bg-success">Valide</span>
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
                <i class="fas fa-edit me-1"></i>Modification du projet
            </h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('/admin/projets/editer/' . ($project['id'] ?? '')) ?>" method="post" enctype="multipart/form-data" id="projectForm">
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
                                   id="title" name="title" value="<?= old('title', $project['title'] ?? '') ?>" 
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
                                      required><?= old('description', $project['description'] ?? '') ?></textarea>
                            <?php if(isset($errors['description'])): ?>
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i><?= $errors['description'] ?>
                                </div>
                            <?php else: ?>
                                <div class="form-text">10 à 255 caractères requis</div>
                            <?php endif; ?>
                            <div class="mt-1">
                                <small class="text-muted">
                                    <span id="descriptionCounter"><?= strlen($project['description'] ?? '') ?></span>/255 caractères
                                </small>
                            </div>
                        </div>

                        <!-- Description complète -->
                        <div class="mb-3">
                            <label for="full_description" class="form-label">
                                Description complète <span class="text-success">(Optionnel)</span>
                            </label>
                            <textarea class="form-control <?= (isset($errors['full_description']) ? 'is-invalid' : '') ?>" 
                                      id="full_description" name="full_description" rows="5"><?= old('full_description', $project['full_description'] ?? '') ?></textarea>
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
                                   id="technologies" name="technologies" 
                                   value="<?= old('technologies', $project['technologies'] ?? '') ?>" 
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
                        <!-- Image actuelle -->
                        <?php if(!empty($project['image'])): ?>
                        <div class="mb-3">
                            <label class="form-label">Image actuelle</label>
                            <div>
                                <img src="<?= base_url('assets/images/projects/' . $project['image']) ?>" 
                                     alt="<?= $project['title'] ?>" class="img-thumbnail" style="max-height: 150px;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1"
                                           <?= old('remove_image') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="remove_image">
                                        <i class="fas fa-trash text-danger me-1"></i>Supprimer l'image
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Nouvelle image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                Nouvelle image <span class="text-success">(Optionnel)</span>
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
                                   id="github_url" name="github_url" 
                                   value="<?= old('github_url', $project['github_url'] ?? '') ?>" 
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
                                   id="demo_url" name="demo_url" 
                                   value="<?= old('demo_url', $project['demo_url'] ?? '') ?>" 
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
                                       <?= (old('featured', $project['featured'] ?? 0) ? 'checked' : '') ?>>
                                <label class="form-check-label" for="featured">
                                    <i class="fas fa-star me-1 text-warning"></i>Projet en vedette
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="active"
                                       <?= (old('status', $project['status'] ?? 'active') === 'active' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="status">
                                    <i class="fas fa-power-off me-1 text-success"></i>Projet actif
                                </label>
                            </div>
                        </div>

                        <!-- Aperçu en temps réel -->
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="card-title"><i class="fas fa-eye me-1"></i>Aperçu des modifications</h6>
                                <p class="small mb-1"><strong id="previewTitle"><?= $project['title'] ?? 'Titre du projet' ?></strong></p>
                                <p class="small text-muted mb-1" id="previewDescription"><?= $project['description'] ?? 'Description courte...' ?></p>
                                <div id="previewTechnologies">
                                    <?php if(!empty($project['technologies'])): ?>
                                        <?php 
                                        $techs = explode(',', $project['technologies']);
                                        foreach($techs as $tech): ?>
                                            <span class="badge bg-secondary me-1 small"><?= trim($tech) ?></span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="badge bg-light text-dark small">Aucune technologie</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations techniques -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <strong>Informations techniques :</strong><br>
                            <small>
                                ID: <?= $project['id'] ?? 'N/A' ?> | 
                                Slug: <?= $project['slug'] ?? 'N/A' ?> | 
                                Créé le: <?= isset($project['created_at']) ? date('d/m/Y H:i', strtotime($project['created_at'])) : 'N/A' ?> |
                                Modifié le: <?= isset($project['updated_at']) ? date('d/m/Y H:i', strtotime($project['updated_at'])) : 'N/A' ?>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex gap-2 justify-content-end mt-4">
                    <a href="<?= base_url('/admin/projets') ?>" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save me-2"></i>Enregistrer les modifications
                    </button>
                </div>
            </form>
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

// Compteur de caractères
document.getElementById('description').addEventListener('input', function() {
    const counter = document.getElementById('descriptionCounter');
    counter.textContent = this.value.length;
    validateField('description', this.value);
});

// Validation en temps réel
function validateField(fieldName, value) {
    const requirement = requirements[fieldName];
    const statusElement = document.querySelector(`[data-field="${fieldName}"]`);
    
    if (!requirement) return true;
    
    let isValid = true;
    let message = '';
    
    if (requirement.required && (!value || value.trim() === '')) {
        isValid = false;
        message = '<i class="fas fa-times text-danger"></i> Requis';
    } else if (value.length < requirement.min) {
        isValid = false;
        message = `<i class="fas fa-times text-danger"></i> Min ${requirement.min} caractères`;
    } else if (requirement.max && value.length > requirement.max) {
        isValid = false;
        message = `<i class="fas fa-times text-danger"></i> Max ${requirement.max} caractères`;
    } else {
        message = '<i class="fas fa-check text-success"></i> Valide';
    }
    
    if (statusElement) {
        statusElement.innerHTML = message;
    }
    
    return isValid;
}

// Validation complète du formulaire
function validateForm() {
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const technologies = document.getElementById('technologies').value;
    
    const titleValid = validateField('title', title);
    const descValid = validateField('description', description);
    const techValid = validateField('technologies', technologies);
    
    const isValid = titleValid && descValid && techValid;
    
    // Mise à jour du panneau de statut
    updateValidationPanel(isValid, { title: titleValid, description: descValid, technologies: techValid });
    
    return isValid;
}

// Mise à jour du panneau de validation
function updateValidationPanel(isValid, fieldStatus) {
    const panel = document.getElementById('validationPanel');
    const status = document.getElementById('validationStatus');
    const badge = document.getElementById('validationBadge');
    const requirementsList = document.getElementById('requirementsList');
    
    let requirementsHtml = '<div class="row small">';
    
    for (const [field, valid] of Object.entries(fieldStatus)) {
        const icon = valid ? 'fa-check text-success' : 'fa-times text-danger';
        const text = valid ? 'Valide' : 'Invalide';
        
        requirementsHtml += `
            <div class="col-md-4 mb-1">
                <i class="fas ${icon} me-1"></i>${getFieldLabel(field)}: ${text}
            </div>
        `;
    }
    
    requirementsHtml += '</div>';
    requirementsList.innerHTML = requirementsHtml;
    
    if (isValid) {
        panel.className = 'card border-success';
        status.innerHTML = '<strong>Formulaire valide !</strong> Vous pouvez enregistrer les modifications.';
        badge.innerHTML = '<span class="badge bg-success">Prêt</span>';
    } else {
        panel.className = 'card border-warning';
        status.innerHTML = '<strong>Champs requis invalides :</strong> Corrigez les erreurs avant enregistrement.';
        badge.innerHTML = '<span class="badge bg-warning">Erreurs</span>';
    }
}

function getFieldLabel(field) {
    const labels = {
        title: 'Titre',
        description: 'Description courte', 
        technologies: 'Technologies'
    };
    return labels[field] || field;
}

// Aperçu en temps réel des modifications
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

// Écouteurs d'événements
['title', 'description', 'technologies'].forEach(field => {
    document.getElementById(field).addEventListener('input', function() {
        validateField(field, this.value);
        validateForm();
        updatePreview();
    });
});

// Aperçu de la nouvelle image
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="mt-2">
                    <p class="small text-success mb-1"><i class="fas fa-image me-1"></i>Nouvelle image sélectionnée:</p>
                    <img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">
                </div>
            `;
        }
        reader.readAsDataURL(this.files[0]);
    }
});

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser le compteur
    const description = document.getElementById('description');
    document.getElementById('descriptionCounter').textContent = description.value.length;
    
    // Initialiser la validation
    validateForm();
    updatePreview();
    
    // Valider les champs initiaux
    validateField('title', document.getElementById('title').value);
    validateField('description', document.getElementById('description').value);
    validateField('technologies', document.getElementById('technologies').value);
});






// Gestion de la cohérence image/suppression
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const removeCheckbox = document.getElementById('remove_image');
    
    // Si on upload une nouvelle image, décocher "supprimer"
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            removeCheckbox.checked = false;
        }
    });
    
    // Si on coche "supprimer", vider le champ image
    removeCheckbox.addEventListener('change', function() {
        if (this.checked) {
            imageInput.value = '';
            document.getElementById('imagePreview').innerHTML = 
                '<p class="text-danger small mt-2"><i class="fas fa-exclamation-triangle me-1"></i>L\'image sera supprimée</p>';
        } else {
            document.getElementById('imagePreview').innerHTML = '';
        }
    });
});

</script>

<?php echo $this->include('admin/templates/footer'); ?>