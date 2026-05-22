<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">Employee List</h1>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('employees.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                Add Employee
            </a>
        @endif

        @if(session('success'))
            <div class="bg-green-200 p-3 mt-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('employees.index') }}" class="mb-4 mt-4 flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search by ID, name, or department..."
                   class="border p-2 rounded">

            <select name="per_page" class="border p-2 rounded">
                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 records</option>
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 records</option>
                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 records</option>
                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 records</option>
            </select>

            <button class="bg-gray-700 text-white px-4 py-2 rounded">
                Search
            </button>
        </form>

        <table class="table-auto w-full mt-6 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Photo</th>
                    <th class="border p-2">Employee ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Department</th>
                    <th class="border p-2">Salary</th>
                    <th class="border p-2">Status</th>

                    @if(auth()->user()->role === 'admin')
                        <th class="border p-2">Actions</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td class="border p-2 text-center">
                            @if($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                     width="60"
                                     height="60"
                                     class="rounded-full object-cover mx-auto">
                            @else
                                <span>No Photo</span>
                            @endif
                        </td>

                        <td class="border p-2">{{ $employee->employee_id }}</td>

                        <td class="border p-2">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </td>

                        <td class="border p-2">{{ $employee->email }}</td>
                        <td class="border p-2">{{ $employee->department }}</td>
                        <td class="border p-2">{{ $employee->salary }}</td>
                        <td class="border p-2">{{ $employee->status }}</td>

                        @if(auth()->user()->role === 'admin')
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
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $employees->links() }}
        </div>

    </div>
</x-app-layout>