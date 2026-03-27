<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            
            // Smart Parsing Logic
            if (preg_match('/salary\s*([><=]+)\s*(\d+)/i', $search, $matches)) {
                $operator = $matches[1];
                $value = $matches[2];
                $query->where('salary', $operator, $value);
            } elseif (preg_match('/department\s*(?:is|:)\s*(\w+)/i', $search, $matches)) {
                $query->where('department', 'like', "%{$matches[1]}%");
            } elseif (preg_match('/status\s*(?:is|:)\s*(\w+)/i', $search, $matches)) {
                $query->where('status', 'like', "%{$matches[1]}%");
            } else {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%")
                        ->orWhere('designation', 'like', "%{$search}%");
                });
            }
        }

        $employees = $query->latest()->paginate(10)->withQueryString();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'join_date' => 'nullable|date',
            'salary' => 'required|numeric|min:0',
        ]);

        $employee = Employee::create($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Employee Created',
            'description' => "Created employee {$employee->first_name} {$employee->last_name} ({$employee->email}) in department {$employee->department}.",
            'metadata' => $employee->toArray(),
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'join_date' => 'nullable|date',
            'salary' => 'required|numeric|min:0',
        ]);

        $oldData = $employee->only(['first_name', 'last_name', 'salary', 'department']);
        $employee->update($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Employee Updated',
            'description' => "Updated details for employee {$employee->first_name} {$employee->last_name}.",
            'metadata' => [
                'old' => $oldData,
                'new' => $employee->only(['first_name', 'last_name', 'salary', 'department']),
            ],
            'ip_address' => request()->ip(),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Employee Deleted',
            'description' => "Deleted employee {$employee->first_name} {$employee->last_name} ({$employee->email}).",
            'metadata' => $employee->toArray(),
            'ip_address' => request()->ip(),
        ]);

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
