<?php

namespace App\Filament\Widgets;

use App\Models\Department;
use App\Models\FacultyMember;
use App\Models\NewsEvent;
use App\Models\Program;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Departments', Department::count())
                ->description('Total departments')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('success'),
            Stat::make('Programs', Program::count())
                ->description('Academic programs')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
            Stat::make('Faculty Members', FacultyMember::count())
                ->description('Total faculty')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
            Stat::make('Users', User::count())
                ->description('System users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            Stat::make('News & Events', NewsEvent::count())
                ->description('Published items')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('danger'),
        ];
    }
}
