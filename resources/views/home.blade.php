<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <title>Employees list</title>
    </head>
    <body>
        <div id="app" class="bg-gradient bg-success vh-100">
            <div class="container-fluid">
                <div class="h1 text-center text-light text-shadow-lg mb-5">Employees list</div>
                @isset($allEmp, $allDeparts, $allSalaries, $allTitles)
                <div class="h3 text-center text-light text-shadow-lg mb-5">Filter by:</div>
                <div class="row d-flex justify-content-center mb-4">
                    <a class="text-center" href="/home/1"><button class="btn btn-primary w-25 m-2">Filter by gender: M</button></a>
                    <a class="text-center" href="/home/2"><button class="btn btn-primary w-25 m-2">Filter by gender: F</button></a>
                    <form class="d-flex justify-content-center mb-2" action="/filterdep" method="get"> Filter department: 
                        <select name="depoption" class="btn btn-primary w-25 m-2">
                            <option value="">choose option</option>
                            @empty($dep)
                                @foreach($allDeparts as $department)
                                    <option value="{{$department->dept_name}}">{{$department->dept_name}}</option>
                                @endforeach
                            @endempty
                            @isset($dep)
                                @foreach($dep as $department)
                                    <option value="{{$department->dept_name}}">{{$department->dept_name}}</option>
                                @endforeach
                            @endisset
                        </select>
                        <button type="submit" class="btn btn-primary w-25">Filter</button>
                    </form>
                    <form class="d-flex justify-content-center mb-2" action="/filteremp" method="get"> Filter employees:
                        <select class="btn btn-primary w-25 m-2" name="empoption">
                            <option value="fired">Employees fired</option>
                            <option value="employed">Employees employed</option>
                        </select>
                        <button type="submit" class="btn btn-primary w-25">Filter</button>
                    </form>
                    <div class="row m-auto"> 
                        <form class="d-flex justify-content-center" action="/filterrange" method="GET">
                            Range of salary: 
                            <input class="form-control w-25 m-1" type="text" name="from" value=""> 
                            - <input class="form-control w-25 m-1" type="text" name="to" value="">
                            <button type="submit" class="btn btn-primary w-25">Filter</button>
                        </form>
                    </div>
                </div>
                <ol class="list-group list-group-numbered w-50 m-auto border border-dark border-1">
                    @foreach($allEmp as $emp)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold">{{$emp->first_name}} {{$emp->last_name}}</div>
                        @foreach($allDeparts as $department)
                            @foreach($allIds as $id)
                                @if($emp->emp_no == $id->emp_no && $department->dept_no == $id->dept_no && $id->to_date > $now && $id->from_date < $now)
                                    Department: {{$department->dept_name}}<br/>
                                @endif
                            @endforeach
                        @endforeach
                        @isset($depoption)
                            Department: {{$depoption}}<br/>
                        @endisset
                        @foreach($allTitles as $title)
                            @if($emp->emp_no == $title->emp_no && $title->to_date > $now && $title->from_date < $now)Job title: {{$title->title}} <br/>@endif
                        @endforeach
                        @foreach($allSalaries as $salary)
                            @if($emp->emp_no == $salary->emp_no && $salary->to_date > $now && $salary->from_date < $now)Salary: {{$salary->salary}} zł@endif
                        @endforeach
                        </div>
                    </li>
                    @endforeach
                </ol>
                <div class="m-auto w-25 mt-5"><a href="/export"><button class="btn btn-secondary">Export list</button></a></div>
                @endisset
                @empty($allEmp && $allDeparts && $allSalaries && $allTitles)
                    <div class="h3 text-center text-white">No data to display.</div>
                @endempty
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>
</html>