<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Audit Logs</h1>

        <table class="table-auto w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">User</th>
                    <th class="border p-2">Action</th>
                    <th class="border p-2">Module</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td class="border p-2">{{ $log->user->name ?? 'Unknown' }}</td>
                        <td class="border p-2">{{ $log->action }}</td>
                        <td class="border p-2">{{ $log->module }}</td>
                        <td class="border p-2">{{ $log->description }}</td>
                        <td class="border p-2">{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>