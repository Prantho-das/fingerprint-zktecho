<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Greeting and Time -->
                        <div class="flex flex-col justify-center">
                            <div class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                                @php
                                $hour = now()->hour;
                                $greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon'
                                    : 'Good Evening' ); @endphp <p>{{ $greeting }}!</p>
                            </div>
                            <div class="text-lg text-gray-600 dark:text-gray-400">
                                <p>Current Time: {{ now()->format('h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Total Users -->
                        <div
                            class="flex flex-col items-center justify-center p-6 text-white bg-indigo-600 rounded-lg shadow-lg">
                            <div class="text-2xl font-semibold">Total Users</div>
                            <div class="text-4xl font-bold">
                                {{ \App\Models\User::count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>