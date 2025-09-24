    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <i class="fas fa-code me-3 fa-2x"></i>
                        <div>
                            <h5 class="mb-0">Abel Kpokouta</h5>
                            <small>Étudiant • Développeur • Data Scientist</small>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="text-lg-end">
                        <div class="social-links mb-3">
                            <?php if(isset($settings['github_url'])): ?>
                            <a href="<?= esc($settings['github_url']) ?>" target="_blank" class="text-white me-3">
                                <i class="fab fa-github fa-lg"></i>
                            </a>
                            <?php endif; ?>
                            
                            <?php if(isset($settings['linkedin_url'])): ?>
                            <a href="<?= esc($settings['linkedin_url']) ?>" target="_blank" class="text-white me-3">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                            <?php endif; ?>
                            
                            <a href="mailto:<?= esc($settings['admin_email'] ?? 'abel.kpokouta@example.com') ?>" class="text-white me-3">
                                <i class="fas fa-envelope fa-lg"></i>
                            </a>
                        </div>
                        <small>&copy; <?= date('Y') ?> Abel Kpokouta. Tous droits réservés.</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <script>
        // Initialisation AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Messages flash
        <?php if(session()->getFlashdata('success')): ?>
        alert('<?= session()->getFlashdata('success') ?>');
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
        alert('Erreur: <?= session()->getFlashdata('error') ?>');
        <?php endif; ?>
    </script>
</body>
</html>