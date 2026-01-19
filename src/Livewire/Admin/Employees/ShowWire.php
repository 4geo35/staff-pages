<?php

namespace GIS\StaffPages\Livewire\Admin\Employees;

use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\StaffPages\Traits\EmployeeEditActions;
use Illuminate\View\View;
use Livewire\Component;

class ShowWire extends Component
{
    use EmployeeEditActions;

    public EmployeeInterface $employee;

    public function render(): View
    {
        return view("sp::livewire.admin.employees.show-wire");
    }
}
