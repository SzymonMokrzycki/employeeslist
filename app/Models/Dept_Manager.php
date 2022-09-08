<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept_Manager extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_no',
        'from_date',
        'to_date'
    ];
}
