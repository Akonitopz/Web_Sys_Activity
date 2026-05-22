<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Attendance Records</h1>

        <a href="{{ route('attendances.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            Record Attendance
        </a>

        @if(session('success'))
            <div class="bg-green-200 p-3 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full mt-6 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Employee</th>
                    <th class="border p-2">Date</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Remarks</th>
                </tr>
            </thead>

            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td class="border p-2">
                            {{ $attendance->employee->first_name }}
                            {{ $attendance->employee->last_name }}
                        </td>
                        <td class="border p-2">{{ $attendance->date }}</td>
                        <td class="border p-2">{{ $attendance->status }}</td>
                        <td class="border p-2">{{ $attendance->remarks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </div>
</x-app-layout>