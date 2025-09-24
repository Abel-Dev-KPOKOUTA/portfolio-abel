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
                        <i class="fas fa-envelope me-2 text-primary"></i>Messages reçus
                    </h1>
                    <p class="text-muted mb-0">Gérez les messages de contact de votre portfolio</p>
                </div>
                <div class="d-flex">
                    <?php if(isset($stats) && $stats['unread_messages'] > 0): ?>
                        <form method="POST" action="<?= base_url('/admin/messages/marquer-tous-lus') ?>" class="me-2">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-check-double me-1"></i>Marquer tous comme lus
                            </button>
                        </form>
                    <?php endif; ?>
                    <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
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

    <!-- Filtres -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-2">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= base_url('/admin/messages') ?>" 
                                   class="btn btn-<?= !$this->request->getGet('filter') ? 'primary' : 'outline-primary' ?>">
                                    Tous (<?= count($messages) ?>)
                                </a>
                                <a href="<?= base_url('/admin/messages?filter=unread') ?>" 
                                   class="btn btn-<?= $this->request->getGet('filter') == 'unread' ? 'warning' : 'outline-warning' ?>">
                                    Non lus (<?= array_reduce($messages, function($carry, $msg) { return $carry + (!$msg->is_read ? 1 : 0); }, 0) ?>)
                                </a>
                                <a href="<?= base_url('/admin/messages?filter=read') ?>" 
                                   class="btn btn-<?= $this->request->getGet('filter') == 'read' ? 'success' : 'outline-success' ?>">
                                    Lus (<?= array_reduce($messages, function($carry, $msg) { return $carry + ($msg->is_read ? 1 : 0); }, 0) ?>)
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" placeholder="Rechercher..." id="searchInput">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des messages -->
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-inbox me-1"></i>Boîte de réception
            </h6>
        </div>
        
        <div class="card-body p-0">
            <?php if(!empty($messages)): ?>
                <div class="list-group list-group-flush" id="messagesList">
                    <?php foreach($messages as $message): ?>
                    <div class="list-group-item list-group-item-action <?= !$message->is_read ? 'bg-light' : '' ?>" 
                         data-message-id="<?= $message->id ?>">
                        <div class="row align-items-center">
                            <div class="col-lg-1 text-center">
                                <?php if(!$message->is_read): ?>
                                    <span class="badge bg-warning" title="Non lu">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted" title="Lu">
                                        <i class="fas fa-envelope-open"></i>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col-lg-2">
                                <strong><?= esc($message->name) ?></strong>
                                <br>
                                <small class="text-muted"><?= esc($message->email) ?></small>
                            </div>
                            
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><?= esc($message->subject) ?></h6>
                                        <p class="mb-1 text-muted small">
                                            <?= esc(substr($message->message, 0, 100)) ?>...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2">
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    <?= $this->timeAgo($message->created_at) ?>
                                </small>
                                <br>
                                <small class="text-muted">
                                    <?= date('d/m/Y H:i', strtotime($message->created_at)) ?>
                                </small>
                            </div>
                            
                            <div class="col-lg-2 text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('/admin/messages/' . $message->id) ?>" 
                                       class="btn btn-outline-primary" title="Voir le message">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <?php if(!$message->is_read): ?>
                                        <form method="POST" action="<?= base_url('/admin/messages/' . $message->id . '/lu') ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-success" title="Marquer comme lu">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            title="Supprimer"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal<?= $message->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Modal de suppression -->
                                <div class="modal fade" id="deleteModal<?= $message->id ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmer la suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Êtes-vous sûr de vouloir supprimer le message de <strong>"<?= esc($message->name) ?>"</strong> ?</p>
                                                <p class="text-muted">Sujet : <?= esc($message->subject) ?></p>
                                                <p class="text-danger"><small>Cette action est irréversible.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <a href="<?= base_url('/admin/messages/' . $message->id . '/supprimer') ?>" 
                                                   class="btn btn-danger">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucun message</h5>
                    <p class="text-muted">Votre boîte de réception est vide.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if(!empty($messages)): ?>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Affichage de <?= count($messages) ?> message(s)
                </small>
                <small class="text-muted">
                    Dernier message : <?= date('d/m/Y H:i', strtotime($messages[0]->created_at)) ?>
                </small>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
// Recherche en temps réel
document.getElementById('searchInput').addEventListener('input', function() {
    const searchText = this.value.toLowerCase();
    const messages = document.querySelectorAll('#messagesList .list-group-item');
    
    messages.forEach(message => {
        const text = message.textContent.toLowerCase();
        message.style.display = text.includes(searchText) ? '' : 'none';
    });
});

// Marquer comme lu au clic
document.querySelectorAll('#messagesList .list-group-item').forEach(item => {
    item.addEventListener('click', function(e) {
        // Éviter si clic sur un bouton
        if (!e.target.closest('.btn') && !e.target.closest('form')) {
            const messageId = this.getAttribute('data-message-id');
            window.location.href = `<?= base_url('/admin/messages/') ?>${messageId}`;
        }
    });
});

// Auto-refresh toutes les 30 secondes pour les nouveaux messages
setInterval(() => {
    fetch('<?= base_url('/admin/messages/check-new') ?>')
        .then(response => response.json())
        .then(data => {
            if (data.hasNewMessages) {
                // Recharger la page silencieusement
                window.location.reload();
            }
        });
}, 30000);
</script>

<?php 
echo $this->include('admin/templates/footer'); 
?>