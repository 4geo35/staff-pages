<?php

namespace GIS\StaffPages\Interfaces;

use ArrayAccess;
use GIS\Metable\Interfaces\ShouldMetaInterface;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JsonSerializable;
use Stringable;
interface EmployeeDepartmentInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString,
    HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable,
    ShouldMetaInterface
{
    public function employees(): BelongsToMany;
    public function orderedEmployees(): BelongsToMany;
    public function offers(): HasMany;
}
