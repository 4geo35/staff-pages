<?php

namespace GIS\StaffPages\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\Metable\Facades\MetaActions;
use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $metas = MetaActions::renderByPage(config("staff-pages.employeePrefix"));
        return view("sp::web.employees.index", compact("metas"));
    }

    public function department(EmployeeDepartmentInterface $department): View
    {
        if (! $department->published_at) { abort(404); }
        $metas = MetaActions::renderByModel($department);
        return view("sp::web.employees.department", compact("metas", "department"));
    }
}
