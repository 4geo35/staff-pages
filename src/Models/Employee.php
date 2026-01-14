<?php

namespace GIS\StaffPages\Models;

use GIS\Fileable\Traits\ShouldImage;
use GIS\Metable\Traits\ShouldMeta;
use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model implements EmployeeInterface
{
    use ShouldMeta, ShouldMarkdown, ShouldImage, ShouldSlug;

    protected string $slugKey = "fio";

    protected $fillable = [
        "last_name",
        "name",
        "patronymic",

        "short",
        "description",
        "comment",

        "published_at",
        "enable_btn",
    ];

    public function departments(): BelongsToMany
    {
        $modelClass = config("staff-pages.customDepartmentModel") ?? EmployeeDepartment::class;
        return $this->belongsToMany($modelClass);
    }

    public function getFioAttribute(): string
    {
        return trim(implode(" ", [
            $this->last_name,
            $this->name,
            $this->patronymic,
        ]));
    }
}
