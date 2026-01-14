<?php

namespace GIS\StaffPages\Observers;

use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\StaffPages\Models\EmployeeDepartment;

class EmployeeDepartmentObserver
{
    public function creating(EmployeeDepartmentInterface $department): void
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $priority = $modelClass::query()
            ->select("id", "priority")
            ->max("priority");
        if (empty($priority)) { $priority = 0; }
        $department->priority = $priority + 1;
    }
}
