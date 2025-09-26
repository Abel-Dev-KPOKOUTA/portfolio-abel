<?php namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table      = 'messages';
    protected $primaryKey = 'id';

    // Dans MessageModel.php - AJOUTER les champs
    protected $allowedFields = [
        'name', 'email', 'subject', 'message', 'ip_address', 
        'user_agent', 'is_read', 'is_archived' // 🔴 AJOUTER
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
