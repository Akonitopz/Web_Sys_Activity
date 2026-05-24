<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Edit Employee</h1>
            <p class="text-gray-600 mb-6">Update employee information and profile photo.</p>

            <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employee Photo</label>

                    <div class="flex items-center gap-4">
                        @if($employee->photo)
                            <img src="{{ asset('storage/' . $employee->photo) }}"
                                 class="w-24 h-24 rounded-full object-cover border shadow">
                        @else
                            <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center text-4xl border">
                                👤
                            </div>
                        @endif

                        <input type="file"
                               name="photo"
                               accept="image/*"
                               class="block w-full text-sm text-gray-700 border rounded p-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                        <input name="employee_id"
                               value="{{ $employee->employee_id }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block     text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email"
                               type="email"
                               value="{{ $employee->email }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input name="first_name"
                               value="{{ $employee->first_name }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input name="last_name"
                               value="{{ $employee->last_name }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <input name="department"
                               value="{{ $employee->department }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                        <input name="salary"
                               type="number"
                               step="0.01"
                               value="{{ $employee->salary }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="border-gray-300 rounded-md shadow-sm w-full">
                            <option value="Active" {{ $employee->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $employee->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded shadow">
                        Update Employee
                    </button>

                    <a href="{{ route('employees.index') }}" class="text-gray-700 hover:text-gray-900">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>