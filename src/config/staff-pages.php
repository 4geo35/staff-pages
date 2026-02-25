<?php

return [
    "employeePrefix" => "employees",
    "employeePageTitle" => "Сотрудники",

    "departmentPrefix" => "departments",
    "departmentPageTitle" => "Отделы",

    "useBreadcrumbs" => true,
    "useH1" => true,

    "useEnableBtn" => true, // значение false вырубит форму

    "fullCol" => false,
    "galleryButton" => 3, // Если поставить число, то будет показываться только если изображений больше этого числа

    // Btn text
    "galleryBtnTitle" => "Документы проверены",
    "modalBtnTitle" => "Записаться на прием",

    // Modal text
    "modalTitle" => "Записаться на прием",
    "modalSubTitle" => "Перезвоним на указанный номер, чтобы подтвердить запись.",
    "modalEmployeeFieldTitle" => "Специалист",

    // Forms
    "availableForms" => [
        "employee-request" => [
            "title" => env("EMPLOYEE_REQUEST_FORM_TITLE", "Записаться на прием"),
            "notificationRow" => "sp::mail.rows.employee-request",
            "component" => "sp-web-employee-form",
            "admin" => "sp::admin.forms.employee-request",
        ],
    ],
    "formExternalExceptions" => ["employee-request"],
    "customWebEmployeeFormComponent" => null,
    "customEmployeeRequestRecordModel" => null,
    "customAdminEmployeeFormTableComponent" => null,

    // Models
    "customDepartmentModel" => null,
    "customDepartmentModelObserver" => null,

    "customEmployeeModel" => null,
    "customEmployeeModelObserver" => null,

    // Controllers
    "customAdminDepartmentController" => null,
    "customAdminEmployeeController" => null,

    "customWebEmployeeController" => null,

    // Components
    "customAdminDepartmentIndexComponent" => null,
    "customAdminDepartmentShowComponent" => null,

    "customAdminEmployeeIndexComponent" => null,
    "customAdminEmployeeShowComponent" => null,

    "customWebEmployeeIndexComponent" => null,

    // Admin form titles
    "employeeShort" => "Специализация",
    "employeeDescription" => "Описание",
    "employeeComment" => "График работы",
    "employeeEnableBtn" => "Включить запись на прием",

    // Policy
    "departmentPolicy" => \GIS\StaffPages\Policies\EmployeeDepartmentPolicy::class,
    "departmentPolicyTitle" => "Управление отделами сотрудников",
    "departmentPolicyKey" => "employee_departments",

    "employeePolicy" => \GIS\StaffPages\Policies\EmployeePolicy::class,
    "employeePolicyTitle" => "Управление сотрудниками",
    "employeePolicyKey" => "employees",

    // Templates
    "templates" => [
        "employee-teaser" => \GIS\StaffPages\Templates\EmployeeTeaser::class,
        "employee-gallery-teaser" => \GIS\StaffPages\Templates\EmployeeGalleryTeaser::class,
    ],
];
