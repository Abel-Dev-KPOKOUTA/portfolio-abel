<?php namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'type', 'location', 'event_date', 'description', 'role', 'result', 'technologies', 'project_link', 'certificate_link', 'is_featured'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}