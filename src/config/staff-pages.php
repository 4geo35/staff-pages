<?php

return [
    "employeePrefix" => "employees",
    "employeePageTitle" => "Сотрудники",

    "departmentPrefix" => "departments",
    "departmentPageTitle" => "Отделы",

    "useBreadcrumbs" => true,
    "useH1" => true,

    "useEnableBtn" => true,

    // Admin
    "customDepartmentModel" => null,
    "customDepartmentModelObserver" => null,

    "customEmployeeModel" => null,
    "customEmployeeModelObserver" => null,

    "customAdminDepartmentController" => null,

    // Form titles
    "employeeShort" => "Специализация",
    "employeeDescription" => "Описание",
    "employeeComment" => "График работы",
    "employeeEnableBtn" => "Включить запись на прием",

    // Components
    "customAdminDepartmentIndexComponent" => null,
    "customAdminDepartmentShowComponent" => null,

    "customAdminEmployeeIndexComponent" => null,
    "customAdminEmployeeShowComponent" => null,

    // Policy
    "departmentPolicy" => \GIS\StaffPages\Policies\EmployeeDepartmentPolicy::class,
    "departmentPolicyTitle" => "Управление отделами сотрудников",
    "departmentPolicyKey" => "employee_departments",

    "employeePolicy" => \GIS\StaffPages\Policies\EmployeePolicy::class,
    "employeePolicyTitle" => "Управление сотрудниками",
    "employeePolicyKey" => "employees",
];
