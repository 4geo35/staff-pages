<?php

namespace GIS\StaffPages\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface EmployeeRequestRecordInterface
{
    public function offer(): HasOne;
}
