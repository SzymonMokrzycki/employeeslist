<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\Salary;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class ListDispController extends Controller
{
    public function index(){
        $allEmp = Employee::all();
        $allDeparts = Department::all();
        $allSalaries = Salary::all();
        $allTitles = Title::all();
        return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles'));
    }
}
