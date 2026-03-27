<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $query = Payroll::with('employee');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $payrolls = $query->orderBy('month', 'desc')->paginate(10)->withQueryString();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|string',
            'basic_salary' => 'required|numeric',
            'allowances' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'payment_date' => 'nullable|date',
        ]);

        $validated['allowances'] = $validated['allowances'] ?? 0;
        $validated['deductions'] = $validated['deductions'] ?? 0;
        $validated['net_salary'] = $validated['basic_salary'] + $validated['allowances'] - $validated['deductions'];
        $validated['status'] = 'pending';

        Payroll::create($validated);

        return redirect()->route('payrolls.index')->with('success', 'Payroll record created successfully.');
    }

    public function generate(Request $request)
    {
        $employees = Employee::all();
        $month = $request->input('month', date('Y-m'));
        $count = 0;

        foreach ($employees as $employee) {
            $exists = Payroll::where('employee_id', $employee->id)
                ->where('month', $month)
                ->exists();

            if (!$exists) {
                Payroll::create([
                    'employee_id' => $employee->id,
                    'month' => $month,
                    'basic_salary' => $employee->salary,
                    'allowances' => 0,
                    'deductions' => 0,
                    'net_salary' => $employee->salary,
                    'status' => 'pending',
                ]);
                $count++;
            }
        }

        return redirect()->route('payrolls.index')->with('success', "Payroll generated for $count employees for $month.");
    }

    public function markAsPaid(Payroll $payroll)
    {
        $payroll->update([
            'status' => 'paid',
            'payment_date' => date('Y-m-d'),
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Payroll Paid',
            'description' => "Marked payroll as paid for {$payroll->employee->first_name} for the month {$payroll->month}.",
            'metadata' => $payroll->toArray(),
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('payrolls.index')->with('success', 'Payroll marked as paid.');
    }

    public function show(Payroll $payroll)
    {
        $payroll->load('employee');
        return view('payrolls.show', compact('payroll'));
    }

    public function edit(Payroll $payroll)
    {
        $payroll->load('employee');
        return view('payrolls.edit', compact('payroll'));
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validated = $request->validate([
            'basic_salary' => 'required|numeric',
            'allowances' => 'required|numeric',
            'deductions' => 'required|numeric',
            'status' => 'required|in:pending,paid',
            'payment_date' => 'nullable|date',
        ]);

        $validated['net_salary'] = $validated['basic_salary'] + $validated['allowances'] - $validated['deductions'];

        $payroll->update($validated);

        return redirect()->route('payrolls.index')->with('success', 'Payroll record updated successfully.');
    }

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();
        return redirect()->route('payrolls.index')->with('success', 'Payroll record deleted.');
    }
}
