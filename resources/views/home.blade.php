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
                <ol class="list-group list-group-numbered w-50 m-auto border border-dark border-1">
                    @foreach($allEmp as $emp)
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold">Name and surname: {{$emp->first_name}} {{$emp->last_name}}</div>
                        Department:<br/>
                        Job title:<br/>
                        Salary:
                        </div>
                    </li>
                    @endforeach
                </ol>
                @endisset
                @empty($allEmp && $allDeparts && $allSalaries && $allTitles)
                    <div class="h3 text-center text-white">No data to display.</div>
                @endempty
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </body>
</html>