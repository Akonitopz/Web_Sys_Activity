<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">Employee List</h1>

        <a href="{{ route('employees.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Employee
        </a>

        @if(session('success'))
            <div class="bg-green-200 p-3 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

    <form method="GET" action="{{ route('employees.index') }}" class="mb-4">
    <input type="text"
           name="search"
           placeholder="Search by ID, name, or department..."
           class="border p-2 rounded">

    <button class="bg-gray-700 text-white px-4 py-2 rounded">
        Search
    </button>
    </form>

        <table class="table-auto w-full mt-6 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Employee ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Department</th>
                    <th class="border p-2">Salary</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td class="border p-2">{{ $employee->employee_id }}</td>
                        <td class="border p-2">
                            {{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </td>
                        <td class="border p-2">{{ $employee->email }}</td>
                        <td class="border p-2">{{ $employee->department }}</td>
                        <td class="border p-2">{{ $employee->salary }}</td>
                        <td class="border p-2">{{ $employee->status }}</td>

                        <td class="border p-2">
                            <a href="{{ route('employees.edit', $employee->id) }}"
                               class="bg-yellow-500 text-white px-2 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('employees.destroy', $employee->id) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-2 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</x-app-layout>