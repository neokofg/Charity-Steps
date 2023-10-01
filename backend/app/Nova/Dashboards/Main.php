<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewUsers;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            NewUsers::make()->width('1/2')->dynamicHeight(),
        ];
    }

    public function name(): string
    {
        return 'Панель управления';
    }
}
