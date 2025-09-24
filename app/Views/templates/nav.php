<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <i class="fas fa-code"></i> Abel Kpokouta
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>#home">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>#about">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>#skills">Compétences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/projects') ?>">Projets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>#events">Événements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/contact') ?>">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>