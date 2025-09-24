<?php namespace App\Models;

use CodeIgniter\Model;

class ExperienceModel extends Model
{
    protected $table = 'experiences';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'company', 'location', 'description', 'start_date', 'end_date', 'current_job', 'type', 'technologies'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}