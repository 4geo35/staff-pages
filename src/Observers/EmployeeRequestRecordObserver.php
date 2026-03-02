<?php

namespace GIS\StaffPages\Observers;

use GIS\StaffPages\Interfaces\EmployeeRequestRecordInterface;

class EmployeeRequestRecordObserver
{
    public function deleted(EmployeeRequestRecordInterface $record): void
    {
        if ($record->doctor) { $record->doctor->delete(); }
    }
}
