<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\Payroll::truncate();
        \App\Models\Employee::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // [first, last, dept, designation, salary, birth_date (month-day), status]
        $employees = [
            ['Arun',     'Kumar',     'IT',         'Senior Developer',     90000, '03-22', 'Active'],
            ['Priya',    'Dharshini', 'HR',         'HR Assistant',         45000, '03-19', 'Active'],
            ['Sanjay',   'Ram',       'Sales',      'Sales Executive',      55000, '04-01', 'Remote'],
            ['Deepika',  'Raj',       'IT',         'UI/UX Designer',       65000, '04-10', 'Active'],
            ['Manoj',    'Prabhakar', 'Finance',    'Accountant',           35000, '05-15', 'Active'],
            ['Sneha',    'Reddy',     'Marketing',  'Digital Marketer',     50000, '02-28', 'Remote'],
            ['Vikram',   'Sethu',     'IT',         'QA Tester',            45000, '03-30', 'Active'],
            ['Anjali',   'Devi',      'HR',         'Recruitment Manager',  75000, '06-12', 'Active'],
            ['Karthick', 'Raja',      'Support',    'Customer Success',     40000, '07-04', 'Remote'],
            ['Meera',    'Jasmine',   'Operations', 'Team Lead',            80000, '08-20', 'Active'],
        ];

        foreach ($employees as $emp) {
            // Use a random birth year for realistic dates
            $birthYear = rand(1988, 1998);
            \App\Models\Employee::create([
                'first_name'  => $emp[0],
                'last_name'   => $emp[1],
                'email'       => strtolower($emp[0] . '.' . str_replace(' ', '', $emp[1])) . '@example.com',
                'phone'       => '9' . rand(100000000, 999999999),
                'department'  => $emp[2],
                'designation' => $emp[3],
                'join_date'   => now()->subMonths(rand(1, 24))->format('Y-m-d'),
                'birth_date'  => $birthYear . '-' . $emp[5],
                'salary'      => $emp[4],
                'status'      => $emp[6],
            ]);
        }
    }
}
