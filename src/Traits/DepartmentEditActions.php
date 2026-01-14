<?php

namespace GIS\StaffPages\Traits;

use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\StaffPages\Models\EmployeeDepartment;
use Illuminate\Auth\Access\AuthorizationException;

trait DepartmentEditActions
{
    public bool $displayDelete = false;
    public bool $displayData = false;

    public int|null $departmentId = null;

    public string $title = "";
    public string $slug = "";
    public string $short = "";
    public string $description = "";

    public function rules(): array
    {
        $uniqueCondition = "unique:employee_departments,slug";
        if ($this->departmentId) { $uniqueCondition .= ",{$this->departmentId}"; }
        return [
            "title" => ["required", "string", "max:250"],
            "slug" => ["nullable", "string", "max:250", $uniqueCondition],
            "short" => ["nullable", "string", "max:250"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок",
            "slug" => "Адресная строка",
            "short" => "Краткое описание",
        ];
    }

    public function closeData(): void
    {
        $this->displayData = false;
        $this->resetFields();
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    protected function resetFields(): void
    {
        $this->reset("title", "slug", "short", "description", "departmentId");
    }

    protected function checkAuth(string $action, EmployeeDepartmentInterface $department = null): bool
    {
        try {
            $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
            $this->authorize($action, $department ?? $modelClass);
            return true;
        } catch (AuthorizationException $e) {
            session()->flash("error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }

    protected function findModel(): ?EmployeeDepartment
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $department = $modelClass::find($this->departmentId);
        if (! $department) {
            session()->flash("error", "Отдел не найден");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $department;
    }
}
