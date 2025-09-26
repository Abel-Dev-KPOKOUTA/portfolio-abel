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
                        <i class="fas fa-cog me-2 text-primary"></i>Paramètres du Site
                    </h1>
                    <p class="text-muted mb-0">Configurez les paramètres de votre portfolio</p>
                </div>
                <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour
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

    <!-- Formulaire des paramètres -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-1"></i>Informations générales
                    </h6>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="<?= base_url('/admin/parametres') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <!-- Titre du site -->
                            <div class="col-md-12 mb-3">
                                <label for="site_title" class="form-label">Titre du site *</label>
                                <input type="text" class="form-control" id="site_title" name="site_title" 
                                       value="<?= old('site_title', $settings['site_title'] ?? '') ?>" required>
                                <div class="form-text">Titre principal qui s'affiche dans l'onglet du navigateur</div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12 mb-3">
                                <label for="site_description" class="form-label">Description *</label>
                                <textarea class="form-control" id="site_description" name="site_description" 
                                          rows="3" required><?= old('site_description', $settings['site_description'] ?? '') ?></textarea>
                                <div class="form-text">Description pour le référencement (SEO)</div>
                            </div>

                            <!-- Email admin -->
                            <div class="col-md-12 mb-3">
                                <label for="admin_email" class="form-label">Email de contact *</label>
                                <input type="email" class="form-control" id="admin_email" name="admin_email" 
                                       value="<?= old('admin_email', $settings['admin_email'] ?? '') ?>" required>
                                <div class="form-text">Email utilisé pour les notifications et le formulaire de contact</div>
                            </div>

                            <!-- Fichier CV -->
                            <div class="col-md-12 mb-3">
                                <label for="cv_file" class="form-label">Nom du fichier CV</label>
                                <input type="text" class="form-control" id="cv_file" name="cv_file" 
                                       value="<?= old('cv_file', $settings['cv_file'] ?? '') ?>">
                                <div class="form-text">Nom du fichier PDF dans le dossier assets/cv/</div>
                            </div>

                            <!-- Upload CV -->
                            <div class="col-md-12 mb-3">
                                <label for="cv_file_upload" class="form-label">Mettre à jour le CV</label>
                                <input type="file" class="form-control" id="cv_file_upload" name="cv_file_upload" 
                                       accept=".pdf">
                                <div class="form-text">Téléchargez un nouveau fichier PDF (remplacera l'ancien)</div>
                            </div>
                        </div>

                        <hr>

                        <!-- Réseaux sociaux -->
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-share-alt me-1"></i>Réseaux sociaux
                        </h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="github_url" class="form-label">GitHub</label>
                                <input type="url" class="form-control" id="github_url" name="github_url" 
                                       value="<?= old('github_url', $settings['github_url'] ?? '') ?>" 
                                       placeholder="https://github.com/votre-compte">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="linkedin_url" class="form-label">LinkedIn</label>
                                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" 
                                       value="<?= old('linkedin_url', $settings['linkedin_url'] ?? '') ?>" 
                                       placeholder="https://linkedin.com/in/votre-profil">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="twitter_url" class="form-label">Twitter</label>
                                <input type="url" class="form-control" id="twitter_url" name="twitter_url" 
                                       value="<?= old('twitter_url', $settings['twitter_url'] ?? '') ?>" 
                                       placeholder="https://twitter.com/votre-compte">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="instagram_url" class="form-label">Instagram</label>
                                <input type="url" class="form-control" id="instagram_url" name="instagram_url" 
                                       value="<?= old('instagram_url', $settings['instagram_url'] ?? '') ?>" 
                                       placeholder="https://instagram.com/votre-compte">
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Enregistrer les modifications
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Panneau d'information -->
        <div class="col-lg-4">
            <!-- Statut du site -->
            <div class="card shadow mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar me-1"></i>Statistiques
                    </h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            Environnement
                            <span class="badge bg-<?= ENVIRONMENT === 'production' ? 'success' : 'warning' ?>">
                                <?= ENVIRONMENT ?>
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            Version CodeIgniter
                            <span class="badge bg-info"><?= CodeIgniter\CodeIgniter::CI_VERSION ?></span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            PHP Version
                            <span class="badge bg-info"><?= PHP_VERSION ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-1"></i>Actions rapides
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('/') ?>" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-external-link-alt me-2"></i>Voir le site
                        </a>
                        <a href="<?= base_url('/admin/projets') ?>" class="btn btn-outline-success">
                            <i class="fas fa-project-diagram me-2"></i>Gérer les projets
                        </a>
                        <a href="<?= base_url('/admin/messages') ?>" class="btn btn-outline-warning">
                            <i class="fas fa-envelope me-2"></i>Voir les messages
                        </a>
                        <a href="<?= base_url('/admin/logout') ?>" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validation du formulaire
document.querySelector('form').addEventListener('submit', function(e) {
    const requiredFields = ['site_title', 'site_description', 'admin_email'];
    let isValid = true;
    
    requiredFields.forEach(field => {
        const input = document.getElementById(field);
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        alert('Veuillez remplir tous les champs obligatoires (*)');
    }
});

// Aperçu des URLs sociales
document.querySelectorAll('input[type="url"]').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.value && !this.value.startsWith('http')) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
});
</script>

<?php 
echo $this->include('admin/templates/footer'); 
?>