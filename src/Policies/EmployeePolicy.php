<?php

namespace GIS\StaffPages\Policies;

use App\Models\User;
use GIS\StaffPages\Interfaces\EmployeeInterface;
use GIS\UserManagement\Facades\PermissionActions;
use GIS\UserManagement\Interfaces\PolicyPermissionInterface;

class EmployeePolicy implements PolicyPermissionInterface
{
    const PERMISSION_KEY = "employees";
    const VIEW_ALL = 2;
    const CREATE = 4;
    const UPDATE = 8;
    const DELETE = 16;
    const ORDER = 32;

    public static function getPermissions(): array
    {
        return [
            self::VIEW_ALL => "Просмотр всех",
            self::CREATE => "Создание",
            self::UPDATE => "Обновление",
            self::DELETE => "Удаление",
            self::ORDER => "Изменение порядка",
        ];
    }

    public static function getDefaults(): int
    {
        return self::VIEW_ALL + self::CREATE + self::UPDATE + self::DELETE + self::ORDER;
    }

    public function viewAny(User $user): bool
    {
        return PermissionActions::allowedAction($user, self::PERMISSION_KEY, self::VIEW_ALL);
    }

    public function create(User $user): bool
    {
        return PermissionActions::allowedAction($user, self::PERMISSION_KEY, self::CREATE);
    }

    public function order(User $user): bool
    {
        return PermissionActions::allowedAction($user, self::PERMISSION_KEY, self::ORDER);
    }

    public function update(User $user, EmployeeInterface $employee): bool
    {
        return PermissionActions::allowedAction($user, self::PERMISSION_KEY, self::UPDATE);
    }

    public function delete(User $user, EmployeeInterface $employee): bool
    {
        return PermissionActions::allowedAction($user, self::PERMISSION_KEY, self::DELETE);
    }
}
