<?php

namespace GIS\StaffPages\Models;

use GIS\RequestForm\Interfaces\CallRequestRecordModelInterface;
use GIS\RequestForm\Traits\ShouldRequestForm;
use GIS\StaffDoctors\Models\OfferRequestRecord;
use GIS\StaffPages\Interfaces\EmployeeRequestRecordInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EmployeeRequestRecord extends Model implements CallRequestRecordModelInterface, EmployeeRequestRecordInterface
{
    use ShouldRequestForm;

    protected $fillable = [
        "fio",
        "name",
        "phone",
        "comment",
    ];

    public function offer(): HasOne
    {
        if (config("staff-doctors")) {
            $modelClass = config("staff-doctors.customOfferRequestRecordModel") ?? OfferRequestRecord::class;
            return $this->hasOne($modelClass, "employee_request_id");
        } else {
            return new HasOne($this->newQuery(), $this, "", "");
        }
    }
}
