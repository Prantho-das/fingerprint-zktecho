<x-app-layout>
  
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Attendance') }}
            </h2>
            </div>
    </x-slot>

    <div class="py-12 light:bg-gray-100">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="p-6">
                    <div class="w-full">
                        <table class="w-full text-sm text-gray-600 border-collapse table-auto dark:text-gray-300">
                            <thead class="bg-indigo-100 dark:bg-indigo-900">
                                <tr class="text-center">
                                    <th class="p-4 font-semibold text-gray-700 dark:text-gray-200">#</th>
                                    <th class="p-4 font-semibold text-gray-700 dark:text-gray-200">Name</th>
                                    <th class="p-4 font-semibold text-gray-700 dark:text-gray-200">Machine ID</th>
                                    <th class="p-4 font-semibold text-gray-700 dark:text-gray-200">Attendance Type</th>
                                    <th class="p-4 font-semibold text-gray-700 dark:text-gray-200">Date</th>
                                    <th class="p-4 font-semibold text-gray-700 dark:text-gray-200">Time</th>
                                    <th class="p-4 font-semibold text-gray-700 dark:text-gray-200">Attended By</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($attendances as $attendance)
                                <tr
                                    class="transition-all duration-200 border-b border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:shadow-lg">
                                    <td class="p-4 text-center">{{ $attendance->id }}</td>
                                    <td class="p-4">{{ $attendance->user->name }}</td>
                                    <td class="p-4 text-center">{{ $attendance->machine_id }}</td>
                                    <td class="p-4 text-center">{{ $attendance->attendance_type }}</td>
                                    <td class="p-4 text-center">{{ $attendance->date }}</td>
                                    <td class="p-4 text-center">{{ $attendance->time }}</td>
                                    <td class="p-4 text-center">{{ $attendance->attendances_by }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-4">
                        {{ $attendances->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>