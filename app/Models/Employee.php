<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'nip', 'name', 'type', 'position', 'subject', 'education',
        'phone', 'email', 'photo_path', 'join_date', 'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'join_date' => 'date'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeTeachers($query)
    {
        return $query->where('type', 'guru');
    }
}
