<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Record Attendance</h1>

        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

            <select name="employee_id" class="border p-2 w-full mb-3" required>
                <option value="">Select Employee</option>

                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->employee_id }} - {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" class="border p-2 w-full mb-3" required>

            <select name="status" class="border p-2 w-full mb-3" required>
                <option value="">Select Status</option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Late">Late</option>
            </select>

            <textarea name="remarks" placeholder="Remarks" class="border p-2 w-full mb-3"></textarea>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Save Attendance</button>
            <a href="{{ route('attendances.index') }}" class="ml-2">Cancel</a>
        </form>
    </div>
</x-app-layout>