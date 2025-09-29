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
                    <?php 
                    $unreadCount = array_reduce($messages, function($carry, $msg) { 
                        return $carry + (!$msg['is_read'] ? 1 : 0); 
                    }, 0); 
                    ?>
                    <?php if($unreadCount > 0): ?>
                        <span class="badge bg-warning me-2"><?= $unreadCount ?> non lu(s)</span>
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

    <!-- Liste des messages -->
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-inbox me-1"></i>Boîte de réception (<?= count($messages) ?> messages)
            </h6>
        </div>
        
        <div class="card-body p-0">
            <?php if(!empty($messages)): ?>
                <div class="list-group list-group-flush">
                    <?php foreach($messages as $message): ?>
                    <div class="list-group-item list-group-item-action <?= !$message['is_read'] ? 'bg-light' : '' ?>">
                        <div class="row align-items-center">
                            <div class="col-lg-1 text-center">
                                <?php if(!$message['is_read']): ?>
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
                                <strong><?= esc($message['name']) ?></strong>
                                <br>
                                <small class="text-muted"><?= esc($message['email']) ?></small>
                            </div>
                            
                            <div class="col-lg-5">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1"><?= esc($message['subject']) ?></h6>
                                        <p class="mb-1 text-muted small">
                                            <?= esc(substr($message['message'], 0, 100)) ?>...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2">
                                <small class="text-muted">
                                    <?= date('d/m/Y H:i', strtotime($message['created_at'])) ?>
                                </small>
                            </div>
                            
                            <div class="col-lg-2 text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('/admin/messages/' . $message['id']) ?>" 
                                       class="btn btn-outline-primary" title="Voir le message">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <?php if(!$message['is_read']): ?>
                                        <form method="POST" action="<?= base_url('/admin/messages/' . $message['id'] . '/lu') ?>" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-outline-success" title="Marquer comme lu">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <button type="button" 
                                            class="btn btn-outline-danger delete-btn" 
                                            title="Supprimer"
                                            data-message-id="<?= $message['id'] ?>"
                                            data-message-name="<?= esc($message['name']) ?>"
                                            data-message-subject="<?= esc($message['subject']) ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
    </div>
</div>

<!-- 🔴 CORRECTION : UN SEUL MODAL DYNAMIQUE -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer le message de <strong id="deleteMessageName"></strong> ?</p>
                <p class="text-muted">Sujet : <span id="deleteMessageSubject"></span></p>
                <p class="text-danger"><small>Cette action est irréversible.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>

<script>
// 🔴 CORRECTION : Gestion des modals avec UN SEUL MODAL DYNAMIQUE
document.addEventListener('DOMContentLoaded', function() {
    // Recherche en temps réel
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const messages = document.querySelectorAll('.list-group-item');
            
            messages.forEach(message => {
                const text = message.textContent.toLowerCase();
                message.style.display = text.includes(searchText) ? '' : 'none';
            });
        });
    }

    // 🔴 CORRECTION : Gestion de la suppression avec modal unique
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteMessageName = document.getElementById('deleteMessageName');
    const deleteMessageSubject = document.getElementById('deleteMessageSubject');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const messageId = this.getAttribute('data-message-id');
            const messageName = this.getAttribute('data-message-name');
            const messageSubject = this.getAttribute('data-message-subject');
            
            // Mettre à jour le modal avec les données du message
            deleteMessageName.textContent = '"' + messageName + '"';
            deleteMessageSubject.textContent = messageSubject;
            confirmDeleteBtn.href = '<?= base_url('/admin/messages/') ?>' + messageId + '/supprimer';
            
            // Afficher le modal
            deleteModal.show();
        });
    });

    // 🔴 CORRECTION : Nettoyage quand le modal est fermé
    document.getElementById('deleteModal').addEventListener('hidden.bs.modal', function () {
        deleteMessageName.textContent = '';
        deleteMessageSubject.textContent = '';
        confirmDeleteBtn.href = '#';
    });
});
</script>

<?php 
echo $this->include('admin/templates/footer'); 
?>