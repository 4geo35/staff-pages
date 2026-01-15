<?php

namespace GIS\StaffPages\Observers;

use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\StaffPages\Models\Employee;

class EmployeeObserver
{
    public function creating(EmployeeInterface $employee): void
    {
        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $priority = $modelClass::query()
            ->select("id", "priority")
            ->max("priority");
        if (empty($priority)) { $priority = 0; }
        $employee->priority = $priority + 1;
    }

    public function deleted(EmployeeInterface $employee): void
    {
        $employee->departments()->detach();
    }
}
