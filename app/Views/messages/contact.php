<?php echo $this->include('templates/header'); ?>

<!-- Hero Section Contact -->
<section class="hero bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>Contactez-moi</h1>
                <p class="lead">Discutons de votre projet, collaboration ou simplement échangeons autour de la tech !</p>
            </div>
            <div class="col-lg-4 text-center">
                <i class="fas fa-envelope-open-text" style="font-size: 8rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-custom">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-4">Envoyez-moi un message</h3>
                        
                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($validation)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                Veuillez corriger les erreurs ci-dessous.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="<?= base_url('/contact') ?>">
                            <?= csrf_field() ?>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="form-label">Votre nom *</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>" 
                                           id="name" name="name" value="<?= old('name', '') ?>" required>
                                    <?php if(isset($validation) && $validation->hasError('name')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('name') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label">Votre email *</label>
                                    <input type="email" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>" 
                                           id="email" name="email" value="<?= old('email', '') ?>" required>
                                    <?php if(isset($validation) && $validation->hasError('email')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="subject" class="form-label">Sujet *</label>
                                <input type="text" class="form-control <?= isset($validation) && $validation->hasError('subject') ? 'is-invalid' : '' ?>" 
                                       id="subject" name="subject" value="<?= old('subject', '') ?>" required>
                                <?php if(isset($validation) && $validation->hasError('subject')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('subject') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mb-4">
                                <label for="message" class="form-label">Votre message *</label>
                                <textarea class="form-control <?= isset($validation) && $validation->hasError('message') ? 'is-invalid' : '' ?>" 
                                          id="message" name="message" rows="6" required><?= old('message', '') ?></textarea>
                                <?php if(isset($validation) && $validation->hasError('message')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('message') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary-custom btn-custom btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Info -->
        <div class="row mt-5">
            <div class="col-lg-4 text-center mb-4">
                <div class="contact-icon">
                    <i class="fas fa-envelope fa-2x text-primary"></i>
                </div>
                <h5>Email</h5>
                <p class="text-muted"><?= esc($settings['admin_email'] ?? 'abel.kpokouta@example.com') ?></p>
                <a href="mailto:<?= esc($settings['admin_email'] ?? 'abel.kpokouta@example.com') ?>" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-envelope me-1"></i>Envoyer un email
                </a>
            </div>
            
            <div class="col-lg-4 text-center mb-4">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                </div>
                <h5>Localisation</h5>
                <p class="text-muted">Cotonou, Bénin</p>
                <p class="text-muted"><i class="fas fa-clock me-1"></i>GMT+1</p>
            </div>
            
            <div class="col-lg-4 text-center mb-4">
                <div class="contact-icon">
                    <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                </div>
                <h5>Disponibilité</h5>
                <p class="text-muted">Étudiant en Génie Math</p>
                <p class="text-muted">Ouvert aux missions freelance</p>
            </div>
        </div>
    </div>
</section>

<?php echo $this->include('templates/footer'); ?>