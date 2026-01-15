<?php

namespace GIS\StaffPages\Livewire\Admin\Departments;

use GIS\StaffPages\Models\EmployeeDepartment;
use GIS\StaffPages\Traits\DepartmentEditActions;
use GIS\TraitsHelpers\Facades\BuilderActions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class IndexWire extends Component
{
    use DepartmentEditActions;

    public string $searchTitle = "";
    public string $searchPublished = "all";

    public bool $displayOrder = false;

    public Collection|null $list = null;
    public bool $hasSearch = false;

    protected function queryString(): array
    {
        return [
            "searchTitle" => ["as" => "title", "except" => ""],
            "searchPublished" => ["as" => "published", "except" => "all"],
        ];
    }

    public function render(): View
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $query = $modelClass::query();
        BuilderActions::extendLike($query, $this->searchTitle, "title");
        BuilderActions::extendPublished($query, $this->searchPublished);
        $query->orderBy("priority");
        $departments = $query->get();

        return view("sp::livewire.admin.departments.index-wire", compact("departments"));
    }

    public function clearSearch(): void
    {
        $this->reset("searchTitle", "searchPublished");
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

        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $modelClass::create([
            "title" => $this->title,
            "slug" => $this->slug,
            "short" => $this->short,
            "description" => $this->description,
        ]);

        session()->flash("success", "Отдел успешно добавлен");
        $this->closeData();
    }

    public function showOrder(): void
    {
        if (! $this->checkAuth("order")) { return; }
        $this->displayOrder = true;
        $this->setDepartmentList();
        $this->dispatch("update-list");
    }

    public function reorderItems(array $newOrder): void
    {
        if (! $this->checkAuth("order")) { return; }

        foreach ($newOrder as $priority => $id) {
            $this->departmentId = $id;
            $department = $this->findModel();
            if (! $department) { continue; }
            $department->priority = $priority;
            $department->save();
        }

        $this->resetFields();
        $this->setDepartmentList();
    }

    protected function setDepartmentList(): void
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $this->list = $modelClass::query()
            ->select("id", "title")
            ->orderBy("priority")
            ->get();
    }
}
