<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Process Payroll</h1>
            <p class="text-gray-600 mb-6">Select an employee and enter payroll details for the selected period.</p>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('payrolls.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employee</label>
                    <select name="employee_id" class="border-gray-300 rounded-md shadow-sm w-full" required>
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->employee_id }} - {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                        <select name="month" class="border-gray-300 rounded-md shadow-sm w-full" required>
                            <option value="">Select Month</option>
                            @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <input type="number" name="year" value="{{ date('Y') }}" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Allowance</label>
                        <input type="number" step="0.01" name="allowance" placeholder="0.00" class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deduction</label>
                        <input type="number" step="0.01" name="deduction" placeholder="0.00" class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded shadow">
                        Process Payroll
                    </button>

                    <a href="{{ route('payrolls.index') }}" class="text-gray-700 hover:text-gray-900">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>