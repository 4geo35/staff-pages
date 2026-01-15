<?php

namespace GIS\StaffPages\Models;

use GIS\Metable\Traits\ShouldMeta;
use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EmployeeDepartment extends Model implements EmployeeDepartmentInterface
{
    use ShouldMeta, ShouldMarkdown, ShouldSlug;

    protected $fillable = [
        "title",
        "slug",
        "short",
        "description",
        "published_at",
    ];

    public function employees(): BelongsToMany
    {
        $modelClass = config("staff-pages.customEmployeeModel") ?? Employee::class;
        return $this->belongsToMany($modelClass, "department_employee", "employee_id", "department_id");
    }
}
