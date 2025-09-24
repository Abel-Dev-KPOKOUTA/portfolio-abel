<?php 
echo $this->include('templates/header'); 
?>

<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Colonne gauche - Image -->
        <div class="col-lg-6 d-none d-lg-block bg-primary">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="text-center text-white p-5">
                    <i class="fas fa-lock fa-5x mb-4"></i>
                    <h2 class="mb-3">Espace Administrateur</h2>
                    <p class="lead">Portfolio Abel Kpokouta</p>
                    <small>Accès réservé à l'administrateur du site</small>
                </div>
            </div>
        </div>
        
        <!-- Colonne droite - Formulaire -->
        <div class="col-lg-6 d-flex align-items-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-10">
                        <div class="text-center mb-5">
                            <a href="<?= base_url('/') ?>" class="text-decoration-none">
                                <h3 class="text-primary">
                                    <i class="fas fa-code me-2"></i>Abel Kpokouta
                                </h3>
                            </a>
                            <p class="text-muted">Connexion à l'administration</p>
                        </div>

                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <div class="card shadow">
                            <div class="card-body p-5">
                                <form method="POST" action="<?= base_url('/admin/login') ?>">
                                    <?= csrf_field() ?>
                                    
                                    <div class="mb-4">
                                        <label for="username" class="form-label">Nom d'utilisateur</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="username" name="username" 
                                                   value="<?= old('username') ?>" required autofocus>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                                        </button>
                                    </div>
                                </form>

                                <div class="text-center mt-4">
                                    <a href="<?= base_url('/') ?>" class="text-muted text-decoration-none">
                                        <i class="fas fa-arrow-left me-1"></i> Retour au site
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt me-1"></i>
                                Accès sécurisé - <?= date('Y') ?>
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
</style>

<?php 
echo $this->include('templates/footer'); 
?>