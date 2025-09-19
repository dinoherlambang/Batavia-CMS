<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
                
            Stat::make('Active Users', User::where('is_active', true)->count())
                ->description('Currently active users')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('Admins', User::role(['super-admin', 'admin'])->count())
                ->description('Admin level users')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('warning'),
                
            Stat::make('Content Creators', User::role(['editor', 'author'])->count())
                ->description('Editors and Authors')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('info'),
        ];
    }
}
