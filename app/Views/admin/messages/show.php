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
                        <i class="fas fa-envelope-open me-2 text-primary"></i>Message
                    </h1>
                    <p class="text-muted mb-0">Détails du message reçu</p>
                </div>
                <div class="d-flex">
                    <a href="<?= base_url('/admin/messages') ?>" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux messages
                    </a>
                    <div class="btn-group">
                        <?php if(!$message['is_read']): ?>
                            <form method="POST" action="<?= base_url('/admin/messages/' . $message['id'] . '/lu') ?>">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check me-2"></i>Marquer comme lu
                                </button>
                            </form>
                        <?php endif; ?>
                        <button type="button" 
                                class="btn btn-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message détaillé -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary"><?= esc($message['subject']) ?></h5>
                        <span class="badge bg-<?= $message['is_read'] ? 'success' : 'warning' ?>">
                            <?= $message['is_read'] ? 'Lu' : 'Non lu' ?>
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- En-tête du message -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-user fa-lg text-primary me-3"></i>
                                <div>
                                    <strong>Expéditeur</strong><br>
                                    <?= esc($message['name']) ?>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope fa-lg text-primary me-3"></i>
                                <div>
                                    <strong>Email</strong><br>
                                    <a href="mailto:<?= esc($message['email']) ?>" class="text-decoration-none">
                                        <?= esc($message['email']) ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-clock fa-lg text-primary me-3"></i>
                                <div>
                                    <strong>Reçu le</strong><br>
                                    <?= date('d/m/Y à H:i', strtotime($message['created_at'])) ?>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-globe fa-lg text-primary me-3"></i>
                                <div>
                                    <strong>IP</strong><br>
                                    <code><?= esc($message['ip_address'] ?? 'Non disponible') ?></code>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Contenu du message -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-align-left me-2"></i>Contenu du message
                        </h6>
                        <div class="bg-light p-4 rounded">
                            <?= nl2br(esc($message['message'])) ?>
                        </div>
                    </div>

                
                    <!-- Actions rapides -->
                    <div class="mt-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-reply me-2"></i>Répondre
                        </h6>
                        <div class="d-flex flex-wrap gap-2">
                            <!-- 🔴 CORRECTION : Lien mailto amélioré -->
                            <a href="mailto:<?= esc($message['email']) ?>?subject=RE: <?= urlencode($message['subject']) ?>&body=Bonjour <?= urlencode($message['name']) ?>," 
                            class="btn btn-primary" target="_blank" id="replyEmail">
                                <i class="fas fa-reply me-2"></i>Répondre par email
                            </a>
                            
                            <button type="button" class="btn btn-outline-primary" onclick="copyEmail()">
                                <i class="fas fa-copy me-2"></i>Copier l'email
                            </button>
                            
                            <button type="button" class="btn btn-outline-secondary" onclick="copyMessage()">
                                <i class="fas fa-copy me-2"></i>Copier le message
                            </button>
                            
                            <!-- 🔴 NOUVEAU : Bouton pour ouvrir Gmail directement -->
                            <button type="button" class="btn btn-outline-info" onclick="openGmail()">
                                <i class="fab fa-google me-2"></i>Ouvrir dans Gmail
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Message ID: #<?= $message['id'] ?>
                            </small>
                        </div>
                        <div class="col-md-6 text-end">
                            <small class="text-muted">
                                <i class="fas fa-sync-alt me-1"></i>
                                Dernière mise à jour: <?= date('H:i:s') ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation entre messages -->
            <div class="d-flex justify-content-between mt-3">
                <a href="<?= base_url('/admin/messages') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-list me-2"></i>Retour à la liste
                </a>
                
                <div class="btn-group">
                    <?php if(isset($previous_message)): ?>
                        <a href="<?= base_url('/admin/messages/' . $previous_message['id']) ?>" 
                           class="btn btn-outline-primary">
                            <i class="fas fa-chevron-left me-2"></i>Précédent
                        </a>
                    <?php endif; ?>
                    
                    <?php if(isset($next_message)): ?>
                        <a href="<?= base_url('/admin/messages/' . $next_message['id']) ?>" 
                           class="btn btn-outline-primary">
                            Suivant <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer le message de <strong>"<?= esc($message['name']) ?>"</strong> ?</p>
                <p class="text-muted">Sujet : <?= esc($message['subject']) ?></p>
                <p class="text-danger"><small>Cette action est irréversible.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="<?= base_url('/admin/messages/' . $message['id'] . '/supprimer') ?>" 
                   class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>

<script>
// Copier l'email dans le clipboard
function copyEmail() {
    const email = '<?= esc($message['email']) ?>';
    navigator.clipboard.writeText(email).then(() => {
        showToast('Email copié dans le presse-papier !', 'success');
    });
}

// Copier le message dans le clipboard
function copyMessage() {
    const message = `De: <?= esc($message['name']) ?> (<?= esc($message['email']) ?>)\nSujet: <?= esc($message['subject']) ?>\n\n<?= esc($message['message']) ?>`;
    navigator.clipboard.writeText(message).then(() => {
        showToast('Message copié dans le presse-papier !', 'success');
    });
}

// Fonction pour afficher les toasts
function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
    toast.style.zIndex = '9999';
    toast.innerHTML = message;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.remove(), 3000);
}

// Raccourcis clavier
document.addEventListener('keydown', function(e) {
    // ESC pour retourner à la liste
    if (e.key === 'Escape') {
        window.location.href = '<?= base_url('/admin/messages') ?>';
    }
    // R pour répondre
    if (e.key === 'r' && !e.ctrlKey) {
        document.querySelector('a[href^="mailto:"]').click();
    }
});

// Copier l'email dans le clipboard
function copyEmail() {
    const email = '<?= esc($message['email']) ?>';
    navigator.clipboard.writeText(email).then(() => {
        showToast('Email copié dans le presse-papier !', 'success');
    });
}

// Copier le message dans le clipboard
function copyMessage() {
    const message = `De: <?= esc($message['name']) ?> (<?= esc($message['email']) ?>)\nSujet: <?= esc($message['subject']) ?>\n\n<?= esc($message['message']) ?>`;
    navigator.clipboard.writeText(message).then(() => {
        showToast('Message copié dans le presse-papier !', 'success');
    });
}

// 🔴 NOUVEAU : Ouvrir Gmail directement
function openGmail() {
    const email = '<?= esc($message['email']) ?>';
    const subject = 'RE: <?= esc($message['subject']) ?>';
    const body = `Bonjour <?= esc($message['name']) ?>,\n\nEn réponse à votre message :\n"<?= esc($message['message']) ?>"\n\n\nCordialement,`;
    
    const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=${encodeURIComponent(email)}&su=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.open(gmailUrl, '_blank');
}

// 🔴 NOUVEAU : Ouvrir Outlook
function openOutlook() {
    const email = '<?= esc($message['email']) ?>';
    const subject = 'RE: <?= esc($message['subject']) ?>';
    const body = `Bonjour <?= esc($message['name']) ?>,\n\nEn réponse à votre message :\n"<?= esc($message['message']) ?>"\n\n\nCordialement,`;
    
    const outlookUrl = `https://outlook.live.com/mail/0/deeplink/compose?to=${encodeURIComponent(email)}&subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.open(outlookUrl, '_blank');
}

// 🔴 CORRECTION : Fonction pour afficher les toasts
function showToast(message, type) {
    // Supprimer les toasts existants
    const existingToasts = document.querySelectorAll('.custom-toast');
    existingToasts.forEach(toast => toast.remove());
    
    const toast = document.createElement('div');
    toast.className = `custom-toast alert alert-${type} position-fixed top-0 end-0 m-3`;
    toast.style.zIndex = '9999';
    toast.innerHTML = message;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.remove(), 3000);
}

// 🔴 NOUVEAU : Détection du client email et action améliorée
document.addEventListener('DOMContentLoaded', function() {
    const replyBtn = document.getElementById('replyEmail');
    
    replyBtn.addEventListener('click', function(e) {
        // Optionnel : demander confirmation
        if (!confirm('Ouvrir votre client email pour répondre à <?= esc($message['name']) ?> ?')) {
            e.preventDefault();
        }
    });
});

// Raccourcis clavier
document.addEventListener('keydown', function(e) {
    // ESC pour retourner à la liste
    if (e.key === 'Escape') {
        window.location.href = '<?= base_url('/admin/messages') ?>';
    }
    // R pour répondre
    if (e.key === 'r' && !e.ctrlKey) {
        document.querySelector('a[href^="mailto:"]').click();
    }
    // G pour Gmail
    if (e.key === 'g' && !e.ctrlKey) {
        openGmail();
    }
});
</script>

<?php  
echo $this->include('admin/templates/footer'); 
?>