<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $routePath = 'dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user() !== null;
    }
}
