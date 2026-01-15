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

    public function showEdit(int $departmentId): void
    {
        $this->resetFields();
        $this->departmentId = $departmentId;
        $department = $this->findModel();
        if (! $department) { return; }
        if (! $this->checkAuth("update", $department)) { return; }

        $this->title = $department->title;
        $this->slug = $department->slug;
        $this->short = $department->short;
        $this->description = $department->description;

        $this->displayData = true;
    }

    public function update(): void
    {
        $department = $this->findModel();
        if (! $department) { return; }
        if (! $this->checkAuth("update", $department)) { return; }
        $this->validate();

        $slugHasChanged = $this->slug !== $department->slug;

        $department->update([
            "title" => $this->title,
            "slug" => $this->slug,
            "short" => $this->short,
            "description" => $this->description,
        ]);
        /**
         * @var EmployeeDepartmentInterface $department
         */
        session()->flash("success", "Отдел успешно обновлен");
        $this->closeData();
        if (isset($this->department)) {
            $this->department->fresh();
            if ($slugHasChanged) {
                $this->redirectRoute("admin.departments.show", ["department" => $this->department]);
            }
        }
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    public function showDelete(int $departmentId): void
    {
        $this->resetFields();
        $this->departmentId = $departmentId;
        $department = $this->findModel();
        if (! $department) { return; }
        if (! $this->checkAuth("delete", $department)) { return; }
        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $department = $this->findModel();
        if (! $department) { return; }
        if (! $this->checkAuth("delete", $department)) { return; }
        try {
            $department->delete();
            session()->flash("success", "Отдел успешно удален");
        } catch (\Exception $e) {
            session()->flash("error", "Ошибка при удалении отдела ");
        }

        $this->closeDelete();
        if (isset($this->department)) {
            $this->redirectRoute("admin.departments.index");
        }
    }

    public function switchPublish(int $departmentId): void
    {
        $this->resetFields();
        $this->departmentId = $departmentId;
        $department = $this->findModel();
        if (! $department) { return; }
        if (! $this->checkAuth("update", $department)) { return; }

        $department->update([
            "published_at" => $department->published_at ? null : now(),
        ]);
        if (isset($this->department)) { $this->department->fresh(); }
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
