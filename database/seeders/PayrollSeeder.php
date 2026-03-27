<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = \App\Models\Employee::all();

        // Seed last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $monthStr = $monthDate->format('Y-m');

            foreach ($employees as $employee) {
                // If it's the current month, some might be pending
                $status = ($i == 0 && rand(0, 1)) ? 'pending' : 'paid';
                
                \App\Models\Payroll::create([
                    'employee_id' => $employee->id,
                    'month' => $monthStr,
                    'basic_salary' => $employee->salary,
                    'allowances' => rand(3000, 7000),
                    'deductions' => rand(1000, 3000),
                    'net_salary' => $employee->salary + rand(1000, 4000),
                    'payment_date' => $status == 'paid' ? $monthDate->format('Y-m-d') : null,
                    'status' => $status,
                ]);
            }
        }
    }
}
