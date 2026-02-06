<?php

namespace GIS\StaffPages\Models;

use GIS\Fileable\Traits\ShouldGallery;
use GIS\Fileable\Traits\ShouldImage;
use GIS\Metable\Traits\ShouldMeta;
use GIS\StaffDoctors\Models\DoctorInfo;
use GIS\StaffDoctors\Models\DoctorOffer;
use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Employee extends Model implements EmployeeInterface
{
    use ShouldMeta, ShouldMarkdown, ShouldImage, ShouldSlug, ShouldGallery;

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
        return $this->belongsToMany($modelClass, "department_employee",  "department_id", "employee_id");
    }

    public function orderedDepartments(): BelongsToMany
    {
        return $this->departments()->orderBy("priority");
    }

    public function doctorInfo(): HasOne
    {
        if (config("staff-doctors")) {
            $modelClass = config("staff-doctors.customDoctorInfoModel") ?? DoctorInfo::class;
            return $this->hasOne($modelClass, "employee_id");
        } else {
            return new HasOne($this->newQuery(), $this, "", "");
        }
    }

    public function offers(): HasMany
    {
        if (config("staff-doctors")) {
            $modelClass = config("staff-doctors.customDoctorOfferModel") ?? DoctorOffer::class;
            return $this->hasMany($modelClass, "doctor_id");
        } else {
            return new HasMany($this->newQuery(), $this, "", "");
        }
    }

    public function getFioAttribute(): string
    {
        return trim(implode(" ", [
            $this->last_name,
            $this->name,
            $this->patronymic,
        ]));
    }

    /**
     * Title for meta
     * @return string
     */
    public function getTitleAttribute(): string
    {
        return $this->fio;
    }

    public function getCommentMarkdownAttribute(): string
    {
        $value = $this->comment;
        if (! $value) return $value;
        return Str::markdown($value);
    }
}
