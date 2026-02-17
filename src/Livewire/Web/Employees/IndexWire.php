<?php

namespace GIS\StaffPages\Livewire\Web\Employees;

use GIS\StaffPages\Models\Employee;
use GIS\StaffPages\Models\EmployeeDepartment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination;

    public Collection|null $departmentList = null;
    public array $searchDepartment = [];

    protected function queryString(): array
    {
        return [
            "searchDepartment" => ["except" => "", "as" => "department"],
        ];
    }

    public function mount(): void
    {
        $this->setDepartmentList();
    }

    public function render(): View
    {
        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        $query = $modelClass::query()
            ->whereNotNull("published_at");
        if (! empty($this->searchDepartment)) {
            $query->whereHas(
                "departments",
                fn($q) => $q->whereIn("slug", $this->searchDepartment)->whereNotNull("published_at")
            );
        }
        $query->with([
            "image", "orderedImages", "departments" => function ($builder) {
                $builder->select("id", "slug", "title");
                $builder->whereNotNull("published_at");
                $builder->orderBy("priority");
            }
        ]);
        $query->orderBy("priority");
        $employees = $query->get();

        return view("sp::livewire.web.employees.index-wire", compact("employees"));
    }

    protected function setDepartmentList(): void
    {
        $departmentModelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        $this->departmentList = $departmentModelClass::query()
            ->select("id", "title", "slug")
            ->whereNotNull("published_at")
            ->orderBy("priority")
            ->get();
    }
}
