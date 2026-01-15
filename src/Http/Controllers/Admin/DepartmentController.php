<?php

namespace GIS\StaffPages\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\StaffPages\Models\EmployeeDepartment;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        Gate::authorize("viewAny", $modelClass);
        return view("sp::admin.departments.index");
    }

    public function show(EmployeeDepartmentInterface $department): View
    {
        Gate::authorize("viewAny", $department);
        return view("sp::admin.departments.show", compact("department"));
    }
}
