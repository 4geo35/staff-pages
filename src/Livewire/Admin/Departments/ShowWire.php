<?php

namespace GIS\StaffPages\Livewire\Admin\Departments;

use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\StaffPages\Traits\DepartmentEditActions;
use Illuminate\View\View;
use Livewire\Component;

class ShowWire extends Component
{
    use DepartmentEditActions;

    public EmployeeDepartmentInterface $department;

    public function render(): View
    {
        return view("sp::livewire.admin.departments.show-wire");
    }
}
