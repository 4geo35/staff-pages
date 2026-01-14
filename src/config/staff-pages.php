<?php

return [
    "employeePrefix" => "employees",

    // Admin
    "customDepartmentModel" => null,
    "customDepartmentModelObserver" => null,

    // Policy
    "departmentPolicy" => \GIS\StaffPages\Policies\EmployeeDepartmentPolicy::class,
    "departmentPolicyTitle" => "Управление отделами сотрудников",
    "departmentPolicyKey" => "employee_departments",
];
