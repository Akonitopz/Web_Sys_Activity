<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Process Payroll</h1>

        @if(session('error'))
            <div class="bg-red-200 p-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('payrolls.store') }}" method="POST">
            @csrf

            <select name="employee_id" class="border p-2 w-full mb-3" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->employee_id }} - {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>

            <select name="month" class="border p-2 w-full mb-3" required>
                <option value="">Select Month</option>
                @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>

            <input type="number" name="year" value="{{ date('Y') }}" class="border p-2 w-full mb-3" required>

            <input type="number" step="0.01" name="allowance" placeholder="Allowance" class="border p-2 w-full mb-3">

            <input type="number" step="0.01" name="deduction" placeholder="Deduction" class="border p-2 w-full mb-3">

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Process Payroll</button>
            <a href="{{ route('payrolls.index') }}" class="ml-2">Cancel</a>
        </form>
    </div>
</x-app-layout>