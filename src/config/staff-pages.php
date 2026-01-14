<?php

return [
    "employeePrefix" => "employees",
    "employeePageTitle" => "Сотрудники",

    "departmentPrefix" => "departments",
    "departmentPageTitle" => "Отделы",

    "useBreadcrumbs" => true,
    "useH1" => true,

    // Admin
    "customDepartmentModel" => null,
    "customDepartmentModelObserver" => null,

    "customEmployeeModel" => null,
    "customEmployeeModelObserver" => null,

    "customAdminDepartmentController" => null,

    // Components
    "customAdminDepartmentIndexComponent" => null,

    // Policy
    "departmentPolicy" => \GIS\StaffPages\Policies\EmployeeDepartmentPolicy::class,
    "departmentPolicyTitle" => "Управление отделами сотрудников",
    "departmentPolicyKey" => "employee_departments",

    "employeePolicy" => \GIS\StaffPages\Policies\EmployeePolicy::class,
    "employeePolicyTitle" => "Управление сотрудниками",
    "employeePolicyKey" => "employees",
];
