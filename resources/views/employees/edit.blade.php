<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Employee</h1>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input name="employee_id" value="{{ $employee->employee_id }}" class="border p-2 w-full mb-3">
            <input name="first_name" value="{{ $employee->first_name }}" class="border p-2 w-full mb-3">
            <input name="last_name" value="{{ $employee->last_name }}" class="border p-2 w-full mb-3">
            <input name="email" value="{{ $employee->email }}" class="border p-2 w-full mb-3">
            <input name="department" value="{{ $employee->department }}" class="border p-2 w-full mb-3">
            <input name="salary" value="{{ $employee->salary }}" class="border p-2 w-full mb-3">

            <select name="status" class="border p-2 w-full mb-3">
                <option value="Active" {{ $employee->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $employee->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('employees.index') }}" class="ml-2">Cancel</a>
        </form>
    </div>
</x-app-layout>