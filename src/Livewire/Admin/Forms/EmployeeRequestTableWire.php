<?php

namespace GIS\StaffPages\Livewire\Admin\Forms;

use GIS\RequestForm\Models\RequestForm;
use GIS\RequestForm\Traits\FormPageActionsTrait;
use GIS\TraitsHelpers\Facades\BuilderActions;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeRequestTableWire extends Component
{
    use FormPageActionsTrait, WithPagination;

    public string $searchName = "";
    public string $searchPhone = "";
    public string $searchFio = "";
    public string $searchFrom = "";
    public string $searchTo = "";
    public string $searchUri = "";
    public string $searchPlace = "";
    public string $searchIp = "";
    public string $searchId = "";

    protected function queryString(): array
    {
        return [
            "searchName" => ["as" => "name", "except" => ""],
            "searchPhone" => ["as" => "phone", "except" => ""],
            "searchFio" => ["as" => "fio", "except" => ""],
            "searchFrom" => ["as" => "from", "except" => ""],
            "searchTo" => ["as" => "to", "except" => ""],
            "searchUri" => ["as" => "uri", "except" => ""],
            "searchPlace" => ["as" => "place", "except" => ""],
            "searchIp" => ["as" => "ip", "except" => ""],
            "searchId" => ["as" => "id", "except" => ""],
            "orderBy" => ["as" => "order-by", "except" => ""],
            "orderByDirection" => ["as" => "direction", "except" => ""],
        ];
    }

    public function render(): View
    {
        $formModelClass = config("request-form.customRequestFormModel") ?? RequestForm::class;
        $query = $formModelClass::query();
        $query
            ->select("request_forms.*")
            ->leftJoin("employee_request_records", "employee_request_records.id", "=", "request_forms.recordable_id")
            ->with(["recordable", "user"])
            ->where("request_forms.type", "employee-request");

        BuilderActions::extendLike($query, $this->searchName, "service_request_records.name");
        BuilderActions::extendLike($query, $this->searchPhone, "service_request_records.phone");
        BuilderActions::extendLike($query, $this->searchFio, "service_request_records.fio");
        BuilderActions::extendDate($query, $this->searchFrom, $this->searchTo, "request_forms.created_at");
        BuilderActions::extendLike($query, $this->searchUri, "request_forms.uri");
        BuilderActions::extendLike($query, $this->searchPlace, "request_forms.place");
        BuilderActions::extendLike($query, $this->searchIp, "request_forms.ip_address");
        BuilderActions::extendLike($query, $this->searchId, "request_forms.id");

        if ($this->orderBy === "created") {
            $orderBy = "request_forms.created_at";
        } else {
            $orderBy = "employee_request_records.{$this->orderBy}";
        }
        $query->orderBy($orderBy, $this->orderByDirection);
        $forms = $query->paginate();

        return view("sp::livewire.admin.forms.employee-request-table-wire", compact("forms"));
    }

    public function clearSearch(): void
    {
        $this->reset(
            "searchName", "searchPhone", "searchFrom", "searchTo", "searchFio",
            "searchUri", "searchPlace", "searchIp", "orderBy", "orderByDirection", "searchId"
        );
        $this->resetPage();
    }
}
