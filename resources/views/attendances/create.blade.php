<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Record Attendance</h1>
            <p class="text-gray-600 mb-6">Select an employee and record their attendance status for the day.</p>

            <form action="{{ route('attendances.store') }}" method="POST" class="space-y-5">
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="date" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="border-gray-300 rounded-md shadow-sm w-full" required>
                            <option value="">Select Status</option>
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                            <option value="Late">Late</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                    <textarea name="remarks"
                              rows="4"
                              placeholder="Optional remarks..."
                              class="border-gray-300 rounded-md shadow-sm w-full"></textarea>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded shadow">
                        Save Attendance
                    </button>

                    <a href="{{ route('attendances.index') }}" class="text-gray-700 hover:text-gray-900">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>