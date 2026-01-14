<?php

return [
    "employeePrefix" => "employees",

    // Admin
    "customDepartmentModel" => null,
    "customDepartmentModelObserver" => null,

    "customEmployeeModel" => null,
    "customEmployeeModelObserver" => null,

    // Policy
    "departmentPolicy" => \GIS\StaffPages\Policies\EmployeeDepartmentPolicy::class,
    "departmentPolicyTitle" => "Управление отделами сотрудников",
    "departmentPolicyKey" => "employee_departments",

    "employeePolicy" => \GIS\StaffPages\Policies\EmployeePolicy::class,
    "employeePolicyTitle" => "Управление сотрудниками",
    "employeePolicyKey" => "employees",
];
