<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept_Emp extends Model
{
    use HasFactory;
    protected $table = 'dept_emp';
    protected $fillable = [
       'emp_no',
       'dept_no',
       'from_date',
       'to_date' 
    ];
}
