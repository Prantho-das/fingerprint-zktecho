<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Employee') }}
            </h2>
            <a href="{{ route('employee.create') }}"
                class="px-4 py-2 text-sm text-white bg-blue-500 rounded-md hover:bg-blue-600">Add User</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto rounded-lg shadow-lg g-white dark:bg-gray-800">
                <div class="p-2">
                    <div class="w-full">
                        <table class="w-full text-sm text-gray-600 border-collapse table-auto dark:text-gray-300">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr class="text-center">
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">#</th>
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">Name</th>
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">Email</th>
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">Phone</th>
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">Role</th>
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">Status</th>
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">Created At</th>
                                    <th class="p-5 font-medium text-gray-600 dark:text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($users as $user)
                                <tr
                                    class="transition-all duration-200 border-b border-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:shadow-lg">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->phone }}</td>
                                    <td class="px-6 py-4">
                                        {{ $user->role == 1 ? 'User' : 'Admin' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 rounded-lg {{ $user->is_active == '1' ? 'bg-green-500' : 'bg-red-500' }} text-white">
                                            {{ $user->is_active == '1' ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $user->created_at->format('d M, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-3">
                                            <!-- Edit Button with SVG Icon -->
                                            <a href="{{ route('employee.edit', $user->id) }}"
                                                class="text-blue-600 hover:text-blue-800 tooltip" data-tooltip="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232a3 3 0 014.24 4.24l-10.485 10.485a1 1 0 01-.386.225l-3.08 1.032a1 1 0 01-1.233-1.233l1.032-3.08a1 1 0 01.225-.386L18.768 5.232z" />
                                                </svg>
                                            </a>

                                            <!-- Delete Button with SVG Icon -->
                                            <form method="POST" action="{{ route('employee.destroy', $user->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 tooltip"
                                                    data-tooltip="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>