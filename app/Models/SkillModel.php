<?php namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table = 'skills';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'category', 'level', 'icon', 'color', 'display_order', 'is_active'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}