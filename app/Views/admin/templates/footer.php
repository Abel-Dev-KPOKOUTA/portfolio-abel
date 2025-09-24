        </div> <!-- End of main content -->

        <!-- Footer -->
        <footer class="bg-light border-top mt-5">
            <div class="container-fluid py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <small class="text-muted">
                            &copy; <?= date('Y') ?> Abel Kpokouta - Admin Panel v1.0
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <small class="text-muted">
                            Connecté depuis: <?= date('d/m/Y H:i', session()->get('admin_login_time')) ?>
                        </small>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });

        // Auto-hide sidebar on mobile
        if (window.innerWidth < 768) {
            document.querySelector('.sidebar').classList.add('collapsed');
        }

        // Messages flash auto-hide
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>