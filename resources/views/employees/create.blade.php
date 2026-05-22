<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Add Employee</h1>

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input name="employee_id" placeholder="Employee ID" class="border p-2 w-full mb-3">
            <input name="first_name" placeholder="First Name" class="border p-2 w-full mb-3">
            <input name="last_name" placeholder="Last Name" class="border p-2 w-full mb-3">
            <input name="email" placeholder="Email" class="border p-2 w-full mb-3">
            <input name="department" placeholder="Department" class="border p-2 w-full mb-3">
            <input name="salary" placeholder="Salary" class="border p-2 w-full mb-3">

            <select name="status" class="border p-2 w-full mb-3">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>

            <input type="file" name="photo" class="border p-2 w-full mb-3">

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('employees.index') }}" class="ml-2">Cancel</a>
        </form>
    </div>
</x-app-layout>