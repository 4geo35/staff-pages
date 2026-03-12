<?php

namespace GIS\StaffPages\Models;

use GIS\Metable\Traits\ShouldMeta;
use GIS\StaffDoctors\Models\DoctorOffer;
use GIS\StaffPages\Interfaces\EmployeeDepartmentInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function orderedEmployees(): BelongsToMany
    {
        return $this->employees()->orderBy("priority");
    }

    public function offers(): HasMany
    {
        if (config("staff-doctors")) {
            $modelClass = config("staff-doctors.customDoctorOfferModel") ?? DoctorOffer::class;
            return $this->hasMany($modelClass, "department_id");
        } else {
            return new HasMany($this->newQuery(), $this, "", "");
        }
    }

    public function getTeaserLinkAttribute(): string
    {
        if (config("staff-pages.departmentAsPages")) {
            return route("web.employees.department", ["department" => $this]);
        }
        $array = [
            route('web.employees.index'),
            "?",
            config("staff-pages.queryDepartmentKey"),
            "[0]",
            "=",
            $this->slug
        ];
        return implode("", $array);
    }
}
