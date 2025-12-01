<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniDistribution extends Model
{
    use HasFactory;

    protected $fillable = ['academic_year_id', 'school_name', 'school_type', 'student_count'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
