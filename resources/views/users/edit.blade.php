<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <div class="p-6">
                    <form action="{{ route('employee.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">

                            <!-- Name, Email, Password -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3 lg:grid-cols-3">
                                <div>
                                    <label for="uid" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        UID (Machine UID If Employee Already Added)
                                    </label>
                                    <input type="number" min="11111" max="65535" name="uid" id="uid"
                                        value="{{ old('uid', $user->uid) }}"
                                        class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-indigo-500"
                                        placeholder="Machine UID">
                                    @error('uid') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="cardno"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Card No
                                    </label>
                                    <input type="text" name="cardno" id="cardno"
                                        value="{{ old('cardno', $user->cardno) }}"
                                        class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-indigo-500"
                                        placeholder="Card No">
                                    @error('cardno') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                        required
                                        class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-indigo-500"
                                        placeholder="Enter user name">
                                    @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                        required
                                        class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-indigo-500"
                                        placeholder="Enter email address">
                                    @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="phone"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">phone</label>
                                    <input type="phone" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                        required
                                        class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-indigo-500"
                                        placeholder="Enter phone address">
                                       @error('phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:focus:ring-indigo-500"
                                        placeholder="Enter new password (leave blank to keep current)">
                                    <span class="text-sm text-gray-500">Leave blank to retain the current
                                        password.</span>
                                    @error('password') <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fingerprint and Face Recognition Checkboxes -->
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
                                <div>
                                    <label for="is_finger_print_added"
                                        class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <input type="checkbox" name="is_finger_print_added" id="is_finger_print_added"
                                            {{ old('is_finger_print_added', $user->is_finger_print_added) ? 'checked' :
                                        '' }}
                                        class="w-5 h-5 text-indigo-600 rounded form-checkbox focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-indigo-500">
                                        <span class="ml-2">Fingerprint Added</span>
                                    </label>
                                    @error('is_finger_print_added') <span class="text-sm text-red-500">{{ $message
                                        }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="is_face_added"
                                        class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <input type="checkbox" name="is_face_added" id="is_face_added" {{
                                            old('is_face_added', $user->is_face_added) ? 'checked' : '' }}
                                        class="w-5 h-5 text-indigo-600 rounded form-checkbox focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-indigo-500">
                                        <span class="ml-2">Face Recognition Added</span>
                                    </label>
                                    @error('is_face_added') <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6 sm:col-span-3">
                                <button type="submit"
                                    class="w-full px-6 py-3 text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    Update User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>