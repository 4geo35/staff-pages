<?php

namespace GIS\StaffPages\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\StaffPages\Models\Employee;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    public function index(): View
    {
        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        Gate::authorize("viewAny", $modelClass);
        return view("sp::admin.employees.index");
    }

    public function show(EmployeeInterface $employee): View
    {
        Gate::authorize("viewAny", $employee);
        $employee->load("orderedDepartments");
        return view("sp::admin.employees.show", compact("employee"));
    }
}
