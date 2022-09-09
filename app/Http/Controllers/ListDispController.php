<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Title;
use App\Models\Salary;
use App\Models\Dept_Emp;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class ListDispController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $allEmp = Employee::all();
        $allDeparts = Department::all();
        $allSalaries = Salary::all();
        $allTitles = Title::all();
        $allIds = Dept_Emp::all();
        return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now'));
    }

    public function filter($filter, $departoption, $empoption){
        if($filter == 1){
            $now = Carbon::now();
            $emp = Employee::all();
            $allEmp = [];
            foreach($emp as $e){
                if($e->gender == 'M'){
                    array_push($allEmp, $e);
                }
            }
            $allDeparts = Department::all();
            $allSalaries = Salary::all();
            $allTitles = Title::all();
            $allIds = Dept_Emp::all();
            return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now'));
        }else if($filter == 2){
            $now = Carbon::now();
            $emp = Employee::all();
            $allEmp = [];
            foreach($emp as $e){
                if($e->geneder == 'F'){
                    array_push($allEmp, $e);
                }
            }
            $allDeparts = Department::all();
            $allSalaries = Salary::all();
            $allTitles = Title::all();
            $allIds = Dept_Emp::all();
            return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now'));
        }else if($filter == 3 && $departoption != 0){
            $now = Carbon::now();
            $emp = Employee::all();
            $allEmp = [];
            $allDeparts = Department::all();
            $allSalaries = Salary::all();
            $allTitles = Title::all();
            $allIds = Dept_Emp::all();
            foreach($emp as $e){
                foreach($allDeparts as $d){
                    if($d->dept_name == $departoption){
                        array_push($allEmp, $e);
                    }
                }
            }
            return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now'));
        }else if($filter == 4 && $empoption != 0){
            $now = Carbon::now();
            $emp = Employee::all();
            $allEmp = [];
            $allDeparts = Department::all();
            $allSalaries = Salary::all();
            $allTitles = Title::all();
            $allIds = Dept_Emp::all();
            foreach($emp as $e){
                if($e->to_date < $now && $empoption == "fired"){
                    array_push($allEmp, $e);
                }else if($e->to_date > $now && $empoption == "employed"){
                    array_push($allEmp, $e);
                }
            }
            return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now'));
        }
    }
}
