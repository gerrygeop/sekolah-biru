<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentStatistic extends Model
{
    use HasFactory;

    protected $fillable = ['academic_year_id', 'grade', 'male_count', 'female_count', 'total_classes'];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
