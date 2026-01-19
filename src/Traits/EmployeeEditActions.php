<?php

namespace GIS\StaffPages\Traits;

use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\StaffPages\Models\Employee;
use GIS\StaffPages\Models\EmployeeDepartment;
use GIS\TraitsHelpers\Traits\WireDeleteImageTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

trait EmployeeEditActions
{
    use WithFileUploads, WireDeleteImageTrait;

    public bool $displayDelete = false;
    public bool $displayData = false;

    public int|null $employeeId = null;

    public string $lastName = '';
    public string $name = '';
    public string $patronymic = '';
    public string $slug = "";
    public string $short = "";
    public string $description = '';
    public string $comment = '';
    public bool $enableBtn = false;
    public TemporaryUploadedFile|null $cover = null;
    public string|null $coverUrl = null;
    public Collection|null $departmentList = null;
    public array $departments = [];

    public function rules(): array
    {
        $uniqueCondition = "unique:employees,slug";
        if ($this->employeeId) { $uniqueCondition .= ",{$this->employeeId}"; }
        return [
            "lastName" => ["required", "string", "max:60"],
            "name" => ["required", "string", "max:60"],
            "patronymic" => ["nullable", "string", "max:60"],
            "slug" => ["nullable", "string", "max:255", $uniqueCondition],
            "short" => ["nullable", "string", "max:255"],
            "cover" => ["nullable", "image", "mimes:jpg,jpeg,png,webp"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "lastName" => "Фамилия",
            "name" => "Имя",
            "patronymic" => "Отчество",
            "slug" => "Адресная строка",
            "short" => "Краткое описание",
            "cover" => "Изображение",
        ];
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showEdit(int $employeeId): void
    {
        $this->resetFields();
        $this->employeeId = $employeeId;
        $employee = $this->findModel();
        if (! $employee) { return; }
        if (! $this->checkAuth("update", $employee)) { return; }

        $this->lastName = $employee->last_name;
        $this->name = $employee->name;
        $this->patronymic = $employee->patronymic;
        $this->slug = $employee->slug;
        $this->short = $employee->short;
        $this->description = $employee->description;
        $this->comment = $employee->comment;
        $this->enableBtn = !empty($employee->enable_btn);
        if ($employee->image_id) {
            $employee->load("image");
            $this->coverUrl = route("thumb-img", ["filename" => $employee->image->filename, "template" => "original"]);
        } else { $this->coverUrl = null; }
        foreach ($employee->departments as $department) {
            $this->departments[] = $department->id;
        }

        $this->displayData = true;
        $this->setDepartmentList();
    }

    public function update(): void
    {
        $employee = $this->findModel();
        if (! $employee) { return; }
        if (! $this->checkAuth("update", $employee)) { return; }
        $this->validate();

        $slugHasChanged = $this->slug !== $employee->slug;

        $employee->update([
            "last_name" => $this->lastName,
            "name" => $this->name,
            "patronymic" => $this->patronymic,
            "slug" => $this->slug,
            "short" => $this->short,
            "description" => $this->description,
            "comment" => $this->comment,
            "enable_btn" => $this->enableBtn ? now() : null,
        ]);
        $employee->livewireImage($this->cover);
        $employee->departments()->sync($this->departments);
        session()->flash("success", "Сотрудник успешно обновлен");
        $this->closeData();

        if (isset($this->employee)) {
            $this->employee = $employee;
            if ($slugHasChanged) {
                $this->redirectRoute("admin.employees.show", compact("employee"));
            }
        }
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function showDelete(int $employeeId): void
    {
        $this->resetFields();
        $this->employeeId = $employeeId;
        $employee = $this->findModel();
        if (! $employee) { return; }
        if (! $this->checkAuth("delete", $employee)) { return; }
        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $employee = $this->findModel();
        if (! $employee) { return; }
        if (! $this->checkAuth("delete", $employee)) { return; }

        try {
            $employee->delete();
            session()->flash("success", "Сотрудник успешно удален");
        } catch (\Exception $exception) {
            session()->flash("error", "Ошибка при удалении сотрудника");
            $this->closeDelete();
            return;
        }

        $this->closeDelete();
        if (isset($this->employee)) {
            $this->redirectRoute("admin.employees.index");
        }
    }

    public function switchPublish(int $employeeId): void
    {
        $this->resetFields();
        $this->employeeId = $employeeId;
        $employee = $this->findModel();
        if (! $employee) { return; }
        if (! $this->checkAuth("update", $employee)) { return; }

        $employee->update([
            "published_at" => $employee->published_at ? null : now(),
        ]);
        if (isset($this->employee)) { $this->employee = $employee; }
    }

    protected function resetFields(): void
    {
        $this->reset(
            "lastName", "name", "patronymic", "slug",
            "short", "description", "comment",
            "enableBtn", "cover", "coverUrl",
            "employeeId", "departments"
        );
    }

    protected function checkAuth(string $action, EmployeeInterface $employee = null): bool
    {
        try {
            $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
            $this->authorize($action, $employee ?? $modelClass);
            return true;
        } catch (AuthorizationException $e) {
            session()->flash("error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }

    protected function findModel(): ?EmployeeInterface
    {
        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $employee = $modelClass::find($this->employeeId);
        if (! $employee) {
            session()->flash("error", "Сотрудник не найден");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $employee;
    }

    protected function setDepartmentList(): void
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $this->departmentList = $modelClass::query()
            ->select("id", "title", "published_at")
            ->orderBy("priority")
            ->get();
    }
}
