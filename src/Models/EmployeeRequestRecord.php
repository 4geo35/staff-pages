<?php

namespace GIS\StaffPages\Models;

use GIS\RequestForm\Interfaces\CallRequestRecordModelInterface;
use GIS\RequestForm\Traits\ShouldRequestForm;
use Illuminate\Database\Eloquent\Model;

class EmployeeRequestRecord extends Model implements CallRequestRecordModelInterface
{
    use ShouldRequestForm;

    protected $fillable = [
        "fio",
        "name",
        "phone",
        "comment",
    ];
}
