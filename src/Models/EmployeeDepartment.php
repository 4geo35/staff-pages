<?php

namespace GIS\StaffPages\Models;

use GIS\Metable\Traits\ShouldMeta;
use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model implements EmployeeDepartmentInterface
{
    use ShouldMeta, ShouldMarkdown, ShouldSlug;

    protected $fillable = [
        "title",
        "slug",
        "short",
        "description",
    ];
}
