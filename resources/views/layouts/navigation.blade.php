<aside class="group fixed left-0 top-0 z-50 w-20 hover:w-64 bg-gray-900 text-white min-h-screen p-4 transition-all duration-300 overflow-hidden">
    <div class="mb-8">
        <div class="text-2xl font-bold">PS</div>
        <div class="hidden group-hover:block text-lg font-bold mt-2">
            Payroll System
        </div>
    </div>

    <nav class="space-y-3">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
            🏠 <span class="hidden group-hover:inline ml-3">Dashboard</span>
        </a>

        <a href="{{ route('employees.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
            👥 <span class="hidden group-hover:inline ml-3">Employees</span>
        </a>

        <a href="{{ route('payrolls.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
            💰 <span class="hidden group-hover:inline ml-3">Payroll</span>
        </a>

        <a href="{{ route('payroll.history') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
            📄 <span class="hidden group-hover:inline ml-3">Payroll History</span>
        </a>

        <a href="{{ route('attendances.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
            🕒 <span class="hidden group-hover:inline ml-3">Attendance</span>
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('audit.logs') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                🛡️ <span class="hidden group-hover:inline ml-3">Audit Logs</span>
            </a>
        @endif
    </nav>
</aside>

<header class="fixed top-0 left-20 right-0 z-40 bg-white shadow px-6 py-4 flex justify-end items-center">
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 focus:outline-none">
            <span>{{ Auth::user()->name }}</span>
            <span>⌄</span>
        </button>

        <div x-show="open"
             @click.outside="open = false"
             class="absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-lg border z-50 py-2">

            <a href="{{ route('profile.edit') }}"
               class="block px-5 py-2 text-gray-700 hover:bg-gray-100">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="w-full text-left block px-5 py-2 text-red-500 hover:bg-gray-100">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</header>