<?php

namespace GIS\StaffPages\Livewire\Admin\Employees;

use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\StaffPages\Models\Employee;
use GIS\StaffPages\Traits\EmployeeEditActions;
use GIS\TraitsHelpers\Facades\BuilderActions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;

class IndexWire extends Component
{
    use EmployeeEditActions;

    public string $searchName = "";
    public string $searchPublished = "all";

    public bool $displayOrder = false;

    public Collection|null $list = null;
    public bool $hasSearch = false;

    protected function queryString(): array
    {
        return [
            "searchName" => ["as" => "name", "except" => ""],
            "searchPublished" => ["as" => "published", "except" => "all"],
        ];
    }

    public function render(): View
    {
        $sqlReplace = "REPLACE(
            CONCAT(
                COALESCE(last_name, ''), COALESCE(name, ''), COALESCE(patronymic, '')
            ), ' ', ' '
        )";

        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $query = $modelClass::query()
            ->select(
                "id", "last_name", "name", "patronymic",
                "image_id", "short", "priority", "published_at", "enable_btn",
                DB::raw("$sqlReplace AS qfn"),
            );
        if (! empty($this->searchName)) {
            $value = trim($this->searchName);
            $query->where(DB::raw($sqlReplace), "like", "%$value%");
        }
        BuilderActions::extendPublished($query, $this->searchPublished);
        $query->orderBy("priority");
        $employees = $query->get();

        return view("sp::livewire.admin.employees.index-wire", compact("employees"));
    }

    public function clearSearch(): void
    {
        $this->reset("searchName", "searchPublished");
    }

    public function showCreate(): void
    {
        $this->resetFields();
        if (! $this->checkAuth("create")) { return; }
        $this->displayData = true;
    }

    public function store(): void
    {
        if (! $this->checkAuth("create")) { return; }
        $this->validate();

        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $employee = $modelClass::query()->create([
            "last_name" => $this->lastName,
            "name" => $this->name,
            "patronymic" => $this->patronymic,
            "slug" => $this->slug,
            "short" => $this->short,
            "description" => $this->description,
            "comment" => $this->comment,
            "enable_btn" => $this->enableBtn ? now() : null,
        ]);
        /**
         * @var EmployeeInterface $employee
         */
        $employee->livewireImage($this->cover);
        session()->flash("success", "Сотрудник успешно добавлен");
        $this->closeData();
    }

    public function showOrder(): void
    {
        if (! $this->checkAuth("order")) { return; }
        $this->displayOrder = true;
        $this->setEmployeeList();
        $this->dispatch("update-list");
    }

    public function reorderItems(array $newOrder): void
    {
        if (! $this->checkAuth("order")) { return; }

        foreach ($newOrder as $priority => $id) {
            $this->employeeId = $id;
            $employee = $this->findModel();
            if (! $employee) { continue; }
            $employee->priority = $priority;
            $employee->save();
        }

        $this->resetFields();
        $this->setEmployeeList();
    }

    protected function setEmployeeList(): void
    {
        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $this->list = $modelClass::query()
            ->select("id", "last_name", "name", "patronymic")
            ->orderBy("priority")
            ->get();
    }
}
