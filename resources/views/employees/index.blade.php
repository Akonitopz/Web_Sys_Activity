<x-app-layout>
    <div class="p-6 pb-40">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">EMPLOYEE DIRECTORY</h1>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('employees.create') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded shadow">
                    Add Employee
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="bg-green-200 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('employees.index') }}" class="mb-6 flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search by ID, name, or department..."
                   class="border p-2 rounded w-80">

            <select name="per_page" class="border p-2 rounded w-40">
                <option value="5" {{ request('per_page', 15) == 5 ? 'selected' : '' }}>5 records</option>
                <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10 records</option>
                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15 records</option>
                <option value="20" {{ request('per_page', 15) == 20 ? 'selected' : '' }}>20 records</option>
            </select>

            <button class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded">
                Search
            </button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($employees as $employee)
                <div class="bg-white rounded-2xl shadow hover:shadow-lg transition p-5 border border-gray-100">

                    <div class="flex gap-4">
                        <div class="shrink-0">
                            @if($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                     class="w-24 h-24 rounded-full object-cover border">
                            @else
                                <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-3xl">
                                    👤
                                </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-800">
                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </h2>

                            <p class="text-sm text-gray-500 mb-2">
                                ID: {{ $employee->employee_id }}
                            </p>

                            <div class="space-y-1 text-sm text-gray-700">
                                <p><strong>Email:</strong> {{ $employee->email }}</p>
                                <p><strong>Department:</strong> {{ $employee->department }}</p>
                                <p><strong>Salary:</strong> ₱{{ number_format($employee->salary, 2) }}</p>
                                <p>
                                    <strong>Status:</strong>
                                    <span class="px-2 py-1 rounded text-white text-xs
                                        {{ $employee->status === 'Active' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $employee->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <div class="flex justify-end gap-2 mt-5">
                            <a href="{{ route('employees.edit', $employee->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                                Edit
                            </a>

                            <form action="{{ route('employees.destroy', $employee->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

        <div class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50">
            <div class="bg-white shadow-lg rounded-xl px-4 py-3 flex flex-col items-center gap-2 border">
                <div class="text-sm text-gray-600">
                    Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} results
                </div>

                <div>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>

    </div>
</x-app-layout>