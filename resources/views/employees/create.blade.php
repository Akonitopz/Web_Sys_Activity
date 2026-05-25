<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Add Employee</h1>
            <p class="text-gray-600 mb-6">Create a new employee record and upload an optional profile photo.</p>

            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employee Photo</label>
                    <input type="file"
                           name="photo"
                           accept="image/*"
                           class="block w-full text-sm text-gray-700 border rounded p-2">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                        <input name="employee_id"
                            value="{{ old('employee_id') }}"
                            placeholder="EMP001"
                            class="border-gray-300 rounded-md shadow-sm w-full @error('employee_id') border-red-500 @enderror">

                        @error('employee_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email"
                               type="email"
                               placeholder="employee@example.com"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input name="first_name"
                               placeholder="First name"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input name="last_name"
                               placeholder="Last name"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <input name="department"
                               placeholder="Department"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Salary</label>
                        <input name="salary"
                               type="number"
                               step="0.01"
                               placeholder="0.00"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="border-gray-300 rounded-md shadow-sm w-full">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded shadow">
                        Save Employee
                    </button>

                    <a href="{{ route('employees.index') }}" class="text-gray-700 hover:text-gray-900">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>