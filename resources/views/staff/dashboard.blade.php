<x-app-layout>
    <div class="max-w-7xl mx-auto py-8">

        <h1 class="text-3xl font-bold text-gray-900 mb-6">
            Staff Dashboard
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Company Memo -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-bold mb-4">
                    📢 Company Memo
                </h2>

                <div class="space-y-4">

                    <div class="border rounded-lg p-4 bg-gray-50">
                        <h3 class="font-semibold text-lg">
                            Payroll Schedule Update
                        </h3>

                        <p class="text-sm text-gray-600 mt-2">
                            Payroll release for this month will be moved to January 30.
                        </p>
                    </div>

                    <div class="border rounded-lg p-4 bg-gray-50">
                        <h3 class="font-semibold text-lg">
                            Team Building Event
                        </h3>

                        <p class="text-sm text-gray-600 mt-2">
                            Company team building will be held next Friday at 2PM.
                        </p>
                    </div>

                </div>
            </div>

            <!-- Company Calendar -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="text-xl font-bold mb-4">
                    📅 Company Calendar
                </h2>

                <div class="space-y-4">

                    <div class="flex justify-between border-b pb-3">
                        <span>Payroll Release</span>
                        <span class="font-semibold">Jan 30</span>
                    </div>

                    <div class="flex justify-between border-b pb-3">
                        <span>Team Building</span>
                        <span class="font-semibold">Feb 02</span>
                    </div>

                    <div class="flex justify-between border-b pb-3">
                        <span>Company Meeting</span>
                        <span class="font-semibold">Feb 05</span>
                    </div>

                </div>
            </div>

        </div>

    </div>
</x-app-layout>