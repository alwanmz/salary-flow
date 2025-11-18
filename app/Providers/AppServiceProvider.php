<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Import Models
use App\Models\Branch;
use App\Models\Department;
use App\Models\Position;
use App\Models\LeaveType;
use App\Models\WorkSchedule;
use App\Models\AllowanceType;
use App\Models\Allowance;
use App\Models\SalaryAdjustment;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\URL;

// Import Observers
use App\Observers\BranchObserver;
use App\Observers\DepartmentObserver;
use App\Observers\PositionObserver;
use App\Observers\LeaveTypeObserver;
use App\Observers\WorkScheduleObserver;
use App\Observers\AllowanceTypeObserver;
use App\Observers\AllowanceObserver;
use App\Observers\SalaryAdjustmentObserver;
use App\Observers\LeaveRequestObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') !== 'local') {
        URL::forceScheme('https');
    }
        // Register ALL Observers HERE
        Branch::observe(BranchObserver::class);
        Department::observe(DepartmentObserver::class);
        Position::observe(PositionObserver::class);
        LeaveType::observe(LeaveTypeObserver::class);
        WorkSchedule::observe(WorkScheduleObserver::class);
        AllowanceType::observe(AllowanceTypeObserver::class);
        Allowance::observe(AllowanceObserver::class);
        SalaryAdjustment::observe(SalaryAdjustmentObserver::class);
        LeaveRequest::observe(LeaveRequestObserver::class);
    }
}
