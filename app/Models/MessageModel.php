<?php namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table      = 'messages';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'email', 'subject', 'message', 'ip_address', 
        'user_agent', 'is_read', 'is_archived'
    ];

    // 🔴 CORRECTION DÉFINITIVE
    protected $useTimestamps = false; // Désactive created_at ET updated_at
}