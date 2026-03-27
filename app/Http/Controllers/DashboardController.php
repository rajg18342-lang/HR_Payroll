<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $aiInsightService;

    public function __construct(\App\Services\AiInsightService $aiInsightService)
    {
        $this->aiInsightService = $aiInsightService;
    }

    public function index()
    {
        $totalEmployees = Employee::count();
        $totalPayrollThisMonth = Payroll::where('month', date('Y-m'))->sum('net_salary');
        $recentEmployees = Employee::latest()->take(10)->get();
        $pendingPayrolls = Payroll::where('status', 'pending')->count();

        // AI Logic: Powered by the AiInsightService
        $aiInsights = $this->aiInsightService->generateInsights();

        // Simulated Attendance Logic based on Employee Statuses
        $attendance = [
            'office'   => Employee::where('status', 'Active')->count(),
            'remote'   => Employee::where('status', 'Remote')->count(),
            'leave'    => Employee::whereNotIn('status', ['Active', 'Remote'])->count(),
        ];
        $attendance['present'] = $attendance['office'] + $attendance['remote'];

        // Data for Monthly Payroll Chart (Last 6 months)
        $months = [];
        $payrollData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $months[] = date('M Y', strtotime("-$i months"));
            $payrollData[] = Payroll::where('month', $month)->sum('net_salary');
        }

        // Data for Department Distribution Chart
        $deptStats = Employee::select('department', \DB::raw('count(*) as count'))
            ->groupBy('department')
            ->get();

        // Upcoming birthdays (next 60 days) - dynamic from employees
        $today = Carbon::today();
        $upcomingBirthdays = Employee::whereNotNull('birth_date')
            ->get()
            ->map(function ($emp) use ($today) {
                $bday = Carbon::parse($emp->birth_date);
                $thisYearBday = $bday->copy()->year($today->year);
                if ($thisYearBday->isPast() && !$thisYearBday->isToday()) {
                    $thisYearBday->addYear();
                }
                $emp->next_birthday = $thisYearBday;
                $emp->days_until = $today->diffInDays($thisYearBday, false);
                return $emp;
            })
            ->filter(fn($emp) => $emp->days_until >= 0 && $emp->days_until <= 60)
            ->sortBy('days_until')
            ->take(1);

        // Static public holidays
        $upcomingHolidays = collect([
            ['name' => 'Holi Festival',    'date' => Carbon::parse('2026-03-25'), 'color' => 'indigo'],
            ['name' => 'Ugadi Holiday',    'date' => Carbon::parse('2026-04-09'), 'color' => 'amber'],
            ['name' => 'Good Friday',      'date' => Carbon::parse('2026-04-03'), 'color' => 'emerald'],
            ['name' => 'Labour Day',       'date' => Carbon::parse('2026-05-01'), 'color' => 'violet'],
        ])->filter(fn($h) => $h['date']->gte(Carbon::today()))->sortBy(fn($h) => $h['date'])->take(2);

        return view('dashboard', compact(
            'totalEmployees',
            'totalPayrollThisMonth',
            'recentEmployees',
            'pendingPayrolls',
            'months',
            'payrollData',
            'deptStats',
            'upcomingBirthdays',
            'upcomingHolidays',
            'attendance',
            'aiInsights'
        ));
    }
}
