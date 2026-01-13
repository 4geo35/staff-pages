<?php

namespace GIS\StaffPages;

use GIS\Fileable\Traits\ExpandTemplatesTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class StaffPagesServiceProvider extends ServiceProvider
{
    use ExpandTemplatesTrait;

    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->mergeConfigFrom(__DIR__ . '/config/staff-pages.php', 'staff-pages');

        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->initFacades();
        $this->bindInterfaces();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'sp');

        $this->expandConfiguration();
        $this->observeModels();
        $this->setPolicies();

        $this->addLivewireComponents();
    }

    protected function initFacades(): void
    {
    }

    protected function bindInterfaces(): void
    {
    }

    protected function expandConfiguration(): void
    {
        $sp = app()->config["staff-pages"];
        $this->expandTemplates($sp);

        $um = app()->config["user-management"];
        $permissions = $um["permissions"];
        // TODO: add permissions
        app()->config["user-management.permissions"] = $permissions;
    }

    protected function observeModels(): void
    {
    }

    protected function setPolicies(): void
    {
        // TODO: set policy gate
    }

    protected function addLivewireComponents(): void
    {
    }
}
