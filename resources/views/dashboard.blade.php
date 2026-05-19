<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            
            <!-- ✅ PART 3: LOGO -->
            <img src="{{ asset('images/logo.png') }}" class="h-10">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                E-Agriculture Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Welcome to your system!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>