<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AiInsightService
{
    /**
     * Generate a collection of professional AI-driven insights.
     */
    public function generateInsights(): Collection
    {
        $insights = collect();

        // 1. Payroll Anomaly Detection
        $this->addPayrollInsights($insights);

        // 2. Resource & Department Allocation Insights
        $this->addEmployeeInsights($insights);

        // 3. Cultural & Calendar Insights
        $this->addCulturalInsights($insights);

        // 4. Predictive Payroll Insights
        $this->addPredictiveInsights($insights);

        return $insights;
    }

    protected function addPayrollInsights(Collection $insights): void
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $lastMonth = Carbon::now()->subMonth()->format('Y-m');

        $currentSum = Payroll::where('month', $currentMonth)->sum('net_salary');
        $lastSum = Payroll::where('month', $lastMonth)->sum('net_salary');

        if ($lastSum > 0) {
            $variance = (($currentSum - $lastSum) / $lastSum) * 100;
            if (abs($variance) > 10) {
                $type = $variance > 0 ? 'warning' : 'info';
                $direction = $variance > 0 ? 'increase' : 'decrease';
                $insights->push([
                    'title' => 'Payroll Variance Detected',
                    'description' => "Current payroll shows a " . abs(round($variance, 1)) . "% $direction compared to last month. Consider reviewing recent salary increments or new hires.",
                    'type' => $type,
                    'icon' => 'currency-dollar',
                    'action' => 'View Payroll Details',
                    'link' => route('payrolls.index'),
                ]);
            }
        }

        $pendingPayrolls = Payroll::where('month', $currentMonth)->where('status', 'pending')->count();
        if ($pendingPayrolls > 0) {
            $insights->push([
                'title' => 'Pending Disbursements',
                'description' => "There are $pendingPayrolls pending payroll records for the current period. Finalize them to maintain scheduled disbursement.",
                'type' => 'alert',
                'icon' => 'clock',
                'action' => 'Execute Payroll',
                'link' => route('payrolls.index'),
            ]);
        }
    }

    protected function addEmployeeInsights(Collection $insights): void
    {
        $totalEmployees = Employee::count();
        $deptStats = Employee::select('department', \DB::raw('count(*) as count'))
            ->groupBy('department')
            ->get();

        foreach ($deptStats as $stat) {
            if ($totalEmployees > 0 && ($stat->count / $totalEmployees) > 0.4) {
                $insights->push([
                    'title' => 'High Departmental Density',
                    'description' => "The {$stat->department} department houses " . round(($stat->count / $totalEmployees) * 100) . "% of your total workforce. Ensure resource balance across other critical functions.",
                    'type' => 'info',
                    'icon' => 'user-group',
                ]);
            }
        }

        // New hire insight
        $newHires = Employee::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        if ($newHires > 0) {
            $insights->push([
                'title' => 'Onboarding Velocity',
                'description' => "You've onboarded $newHires new talents in the last 30 days. Consider conducting 'First Month Sync' sessions for better retention.",
                'type' => 'success',
                'icon' => 'bolt',
                'action' => 'View New Employees',
                'link' => route('employees.index'),
            ]);
        }
    }

    protected function addCulturalInsights(Collection $insights): void
    {
        $today = Carbon::today();
        $upcomingBirthdays = Employee::whereNotNull('birth_date')
            ->get()
            ->filter(function ($emp) use ($today) {
                $bday = Carbon::parse($emp->birth_date)->year($today->year);
                if ($bday->isPast() && !$bday->isToday()) $bday->addYear();
                return $today->diffInDays($bday, false) <= 7;
            });

        if ($upcomingBirthdays->isNotEmpty()) {
            $names = $upcomingBirthdays->pluck('first_name')->join(', ');
            $insights->push([
                'title' => 'Cultural Engagement Opportunity',
                'description' => "Upcoming birthdays this week: $names. Organizing a small team recognition can boost organizational morale.",
                'type' => 'sparkle',
                'icon' => 'cake',
            ]);
        }
    }

    protected function addPredictiveInsights(Collection $insights): void
    {
        $currentMonth = Carbon::now()->format('Y-m');
        $months = [];
        $totals = [];

        for ($i = 3; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $months[] = $month;
            $totals[] = Payroll::where('month', $month)->sum('net_salary');
        }

        $currentTotal = end($totals);
        $previousTotal = $totals[count($totals) - 2] ?? 0;

        if ($previousTotal > 0) {
            $growthRate = ($currentTotal - $previousTotal) / $previousTotal;
            $projectedNextMonth = $currentTotal * (1 + $growthRate);

            $direction = $growthRate >= 0 ? 'upward' : 'downward';
            $type = $growthRate > 0.05 ? 'warning' : 'info'; // High growth (>5%) is a warning for budget

            $insights->push([
                'title' => 'Payroll Forecast (Next Month)',
                'description' => "Based on current trends, next month's payroll is projected to be around ₹" . number_format($projectedNextMonth, 2) . ". This follows a " . round($growthRate * 100, 1) . "% $direction trend.",
                'type' => $type,
                'icon' => 'trending-up',
            ]);
        }
    }
}
