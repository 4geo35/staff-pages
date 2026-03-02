<?php

namespace GIS\StaffPages;

use GIS\Fileable\Traits\ExpandTemplatesTrait;
use GIS\RequestForm\Traits\ExpandFormsTrait;
use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\StaffPages\Livewire\Admin\Forms\EmployeeRequestTableWire;
use GIS\StaffPages\Livewire\Web\Forms\WebEmployeeFormWire;
use GIS\StaffPages\Models\Employee;
use GIS\StaffPages\Models\EmployeeDepartment;
use GIS\StaffPages\Models\EmployeeRequestRecord;
use GIS\StaffPages\Observers\EmployeeDepartmentObserver;
use GIS\StaffPages\Observers\EmployeeObserver;
use GIS\StaffPages\Observers\EmployeeRequestRecordObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use GIS\StaffPages\Livewire\Admin\Departments\IndexWire as AdminDepartmentIndexWire;
use GIS\StaffPages\Livewire\Admin\Departments\ShowWire as AdminDepartmentShowWire;
use GIS\StaffPages\Livewire\Admin\Employees\IndexWire as AdminEmployeeIndexWire;
use GIS\StaffPages\Livewire\Admin\Employees\ShowWire as AdminEmployeeShowWire;
use GIS\StaffPages\Livewire\Web\Employees\IndexWire as WebEmployeeIndexWire;

class StaffPagesServiceProvider extends ServiceProvider
{
    use ExpandTemplatesTrait, ExpandFormsTrait;

    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->mergeConfigFrom(__DIR__ . '/config/staff-pages.php', 'staff-pages');

        $this->bindInterfaces();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'sp');

        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->expandConfiguration();
        $this->observeModels();
        $this->setPolicies();

        $this->addLivewireComponents();
    }

    protected function bindInterfaces(): void
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $this->app->bind(EmployeeDepartmentInterface::class, $modelClass);

        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $this->app->bind(EmployeeInterface::class, $modelClass);
    }

    protected function expandConfiguration(): void
    {
        $sp = app()->config["staff-pages"];
        $this->expandTemplates($sp);
        if (config("staff-pages.useAvailableForms")) {
            $this->expandForms($sp);
        }

        $um = app()->config["user-management"];
        $permissions = $um["permissions"];
        $permissions[] = [
            "policy" => $sp["departmentPolicy"],
            "title" => $sp["departmentPolicyTitle"],
            "key" => $sp["departmentPolicyKey"],
        ];
        $permissions[] = [
            "policy" => $sp["employeePolicy"],
            "title" => $sp["employeePolicyTitle"],
            "key" => $sp["employeePolicyKey"],
        ];
        app()->config["user-management.permissions"] = $permissions;
    }

    protected function observeModels(): void
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $observerClass = config("staff-pages.customDepartmentModelObserver") ?? EmployeeDepartmentObserver::class;
        $modelClass::observe($observerClass);

        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $observerClass = config("staff-pages.customEmployeeModelObserver") ?? EmployeeObserver::class;
        $modelClass::observe($observerClass);

        $modelClass = config("staff-pages.customEmployeeRequestRecordModel") ?? EmployeeRequestRecord::class;
        $observerClass = config("staff-pages.customEmployeeRequestRecordObserver") ?? EmployeeRequestRecordObserver::class;
        $modelClass::observe($observerClass);
    }

    protected function setPolicies(): void
    {
        Gate::policy(config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class, config("staff-pages.departmentPolicy"));
        Gate::policy(config("staff-pages.customEmployeeModel") ?? Employee::class, config("staff-pages.employeePolicy"));
    }

    protected function addLivewireComponents(): void
    {
        $component = config("staff-pages.customAdminDepartmentIndexComponent");
        Livewire::component(
            "sp-admin-department-index",
            $component ?? AdminDepartmentIndexWire::class
        );

        $component = config("staff-pages.customAdminDepartmentShowComponent");
        Livewire::component(
            "sp-admin-department-show",
            $component ?? AdminDepartmentShowWire::class
        );

        $component = config("staff-pages.customAdminEmployeeIndexComponent");
        Livewire::component(
            "sp-admin-employee-index",
            $component ?? AdminEmployeeIndexWire::class
        );

        $component = config("staff-pages.customAdminEmployeeShowComponent");
        Livewire::component(
            "sp-admin-employee-show",
            $component ?? AdminEmployeeShowWire::class
        );

        $component = config("staff-pages.customWebEmployeeIndexComponent");
        Livewire::component(
            "sp-web-employee-index",
            $component ?? WebEmployeeIndexWire::class
        );

        $component = config("staff-pages.customWebEmployeeFormComponent");
        Livewire::component(
            "sp-web-employee-form",
            $component ?? WebEmployeeFormWire::class
        );

        $component = config("staff-pages.customAdminEmployeeFormTableComponent");
        Livewire::component(
            "sp-admin-employee-form-table",
            $component ?? EmployeeRequestTableWire::class
        );
    }
}
