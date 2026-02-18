<?php

namespace GIS\StaffPages\Livewire\Web\Forms;

use GIS\RequestForm\Facades\FormActions;
use GIS\RequestForm\Interfaces\RequestFormShowInterface;
use GIS\RequestForm\Traits\RequestFormActionsTrait;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class WebEmployeeFormWire extends Component implements RequestFormShowInterface
{
    use RequestFormActionsTrait;

    public string $formName = "employee-request";
    public bool $modal = true;
    public string $postfix = "";
    public string $double = "";
    public string $prefix = "";

    public string $employeeFio = "";
    public string $hidden = "";

    public string $name = "";
    public string $phone = "";
    public string $comment = "";
    public bool $privacy = true;

    public function rules(): array
    {
        return FormActions::prepareValidation([
            "name" => ["required", "string", "max:50"],
            "phone" => ["required", "string", "max:18", "min:18"],
            "privacy" => ["required"],
            "employeeFio" => ["required", "string", "max:250"],
        ]);
    }

    public function validationAttributes(): array
    {
        return [
            "name" => "Имя",
            "phone" => "Номер телефона",
            "privacy" => "Политика конфиденциальности",
            "employeeFio" => config("staff-pages.modalEmployeeFieldTitle"),
        ];
    }

    public function render(): View
    {
        return view("sp::livewire.web.forms.web-employee-form-wire");
    }

    #[On("show-employee-form")]
    public function showEmployeeForm(string $key, string $employeeFio, string $place = null): void
    {
        if ($place) { $this->place = $place; }
        else { $this->reset("place"); }
        $this->resetFields();
        $this->employeeFio = $employeeFio;
        $this->displayForm = true;
    }

    public function store(): void
    {
        $this->validate();
    }

    public function resetFields(): void
    {
        $this->reset("name", "phone", "comment", "privacy", "employeeFio");
    }
}
