<?php

namespace GIS\StaffPages\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\Metable\Facades\MetaActions;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $metas = MetaActions::renderByPage(config("staff-pages.employeePrefix"));
        return view("sp::web.employees.index", compact("metas"));
    }
}
