<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Title;
use App\Models\Salary;
use App\Models\Dept_Emp;
use App\Models\Employee;
use File;
use App\Models\Department;
use Illuminate\Http\Request;
use Response;

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

    public function filter($filter){
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
        }
    }

    public function filterOptionDepartment(Request $request){
        $now = Carbon::now();
        $emp = Employee::all();
        $allEmp = [];
        $dep = Department::all();
        $allDeparts = [];
        $allSalaries = Salary::all();
        $allTitles = Title::all();
        $allIds = Dept_Emp::all();
        $i = 0;
        $depoption = $request->depoption;
        foreach($dep as $d){
            if($d->dept_name == $request->depoption){
                array_push($allEmp, $emp[$i]); 
                array_push($allDeparts, $d);
            }
            $i++;
        }
        return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now', 'depoption', 'dep'));
    }

    public function filterOptionEmployees(Request $request){
        
        $now = Carbon::now();
        $emp = Employee::all();
        $allEmp = [];
        $allDeparts = Department::all();
        $allSalaries = Salary::all();
        $allTitles = Title::all();
        $allIds = Dept_Emp::all();
        foreach($emp as $e){
            if($e->to_date < $now && $request->empoption == "fired"){
                array_push($allEmp, $e);
            }else if($e->to_date > $now && $request->empoption == "employed"){
                array_push($allEmp, $e);
            }
        }
        return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now'));
    
    }

    public function rangeSalary(Request $request){
        
        $now = Carbon::now();
        $emp = Employee::all();
        $allEmp = [];
        $allDeparts = Department::all();
        $allSalaries = Salary::all();
        $allTitles = Title::all();
        $allIds = Dept_Emp::all();
        $i = 0;
        foreach($allSalaries as $s){
            if($request->from < $s->salary && $request->to > $s->salary){
                array_push($allEmp, $emp[$i]);
            }
            $i++;
        }
        return view('home', compact('allEmp', 'allDeparts', 'allSalaries', 'allTitles', 'allIds', 'now'));
    
    }

    public function export(){
        $now = Carbon::now();
        $emp = Employee::all();
        $allEmp = [];
        $allDeparts = Department::all();
        $allSalaries = Salary::all();
        $allTitles = Title::all();
        $allIds = Dept_Emp::all();
        $deps = [];
        $titles = [];
        $salaries= [];
        $i = 0;

        foreach($allDeparts as $department){
            foreach($allIds as $id){
                if($emp[$i]->emp_no == $id->emp_no && $department->dept_no == $id->dept_no && $id->to_date > $now && $id->from_date < $now){
                    array_push($deps, $allDeparts[$i]);
                }
            }
            $i++;
        }  
        $i = 0;
        foreach($allTitles as $title){
            if($emp[$i]->emp_no == $title->emp_no && $title->to_date > $now && $title->from_date < $now){
                array_push($titles, $allTitles[$i]);
            }
            $i++;
        }
        $i = 0;
        foreach($allSalaries as $salary){
            if($emp[$i]->emp_no == $salary->emp_no && $salary->to_date > $now && $salary->from_date < $now){
                array_push($salaries, $allSalaries[$i]);
            }
            $i++;
        }
        
        $array = array("employees" => $emp, "departments" => $deps, "titles" => $titles, "salaries" => $salaries);
        $json = json_encode($array);
        $jsongFile = time() . '_file.json';
	    File::put(public_path(''.$jsongFile), $json);
	    return Response::download(public_path(''.$jsongFile));
    }
}
