<?php 
echo $this->include('templates/header'); 
?>

<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Colonne gauche - Présentation -->
        <div class="col-lg-6 d-none d-lg-block bg-primary">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="text-center text-white p-5">
                    <i class="fas fa-lock fa-5x mb-4"></i>
                    <h2 class="mb-3">Espace Administrateur</h2>
                    <p class="lead">Portfolio Abel Kpokouta</p>
                    <div class="mt-4">
                        <small>
                            <i class="fas fa-shield-alt me-1"></i>
                            Accès sécurisé au backoffice
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Colonne droite - Formulaire -->
        <div class="col-lg-6 d-flex align-items-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-10">
                        <!-- Logo et titre -->
                        <div class="text-center mb-5">
                            <a href="<?= base_url('/') ?>" class="text-decoration-none">
                                <h3 class="text-primary mb-2">
                                    <i class="fas fa-code me-2"></i>Abel Kpokouta
                                </h3>
                            </a>
                            <p class="text-muted">Connexion à l'administration du portfolio</p>
                        </div>

                        <!-- Messages flash -->
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Carte formulaire -->
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-5">
                                <h4 class="card-title text-center mb-4">
                                    <i class="fas fa-user-shield me-2"></i>Connexion Admin
                                </h4>
                                
                                <form method="POST" action="<?= base_url('/admin/login') ?>">
                                    <?= csrf_field() ?>
                                    
                                    <!-- Champ utilisateur -->
                                    <div class="mb-4">
                                        <label for="username" class="form-label fw-bold">
                                            <i class="fas fa-user me-2"></i>Nom d'utilisateur
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-user text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control" id="username" name="username" 
                                                   value="<?= old('username') ?>" 
                                                   placeholder="Entrez votre nom d'utilisateur" 
                                                   required autofocus>
                                        </div>
                                    </div>

                                    <!-- Champ mot de passe -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label fw-bold">
                                            <i class="fas fa-lock me-2"></i>Mot de passe
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-key text-primary"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" 
                                                   placeholder="Entrez votre mot de passe" required>
                                        </div>
                                    </div>

                                    <!-- Bouton connexion -->
                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-primary btn-lg py-2">
                                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                        </button>
                                    </div>
                                </form>

                                <!-- Lien retour -->
                                <div class="text-center mt-4">
                                    <a href="<?= base_url('/') ?>" class="text-muted text-decoration-none">
                                        <i class="fas fa-arrow-left me-1"></i> Retour au portfolio
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Informations de sécurité -->
                        <div class="text-center mt-4">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                <?= date('d/m/Y H:i') ?> • 
                                <?= ENVIRONMENT === 'production' ? 'Production' : 'Développement' ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.min-vh-100 {
    min-height: 100vh;
}

.card {
    border-radius: 15px;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    transition: transform 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
}
</style>

<script>
// Focus sur le premier champ
document.getElementById('username').focus();

// Enter pour soumettre le formulaire
document.getElementById('password').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.querySelector('form').submit();
    }
});
</script>

<?php 
echo $this->include('templates/footer'); 
?>