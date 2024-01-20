<x-admin-layout>
<!-- Page Content -->
<div class="py-12 w-full">
    <div class="block">
        <div class="w-full px-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="block py-2 text-x font-medium leading-6 text-gray-900"><strong>Add Students</strong></h1>
                        <form method="POST" action="{{ route('admin.students.store') }}">
                        @csrf
                        
                                <div class="block mt-1">
                                    <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="block mt-1">
                                    <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="block mt-1">
                                    <x-input-label for="parent_phone" :value="__('Parent Phone')" />
                                        <x-text-input id="parent_phone" class="block mt-1 w-full" type="tel" name="parent_phone" :value="old('parent_phone')" required autocomplete="parent_phone" />
                                    <x-input-error :messages="$errors->get('parent_phone')" class="mt-2" />
                                </div>
                                <div class="block mt-1">
                                    <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="block mt-1">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password_confirmation"
                                                        required autocomplete="password_confirmation" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                <div class="block mt-1">
                                    <x-input-label for="class_id" :value="__('Select Class')"/>
                                    <select id="class_id" name="class_id" class="block mt-1 w-full sm:rounded-lg" required autocomplete="class_id">
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="block mt-1">
                                    <x-input-label for="role_id" :value="__('Registered As')" />
                                    <select id="role_id" name="role_id" class="block mt-1 w-full sm:rounded-lg">
                                        <option value="3">Student</option>
                                    </select>   
                                </div>
                                <div class="block mt-6 flex items-center justify-end gap-x-6">
                                <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                                    <x-primary-button class="ms-4">
                                        {{ __('Add User') }}
                                    </x-primary-button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="w-full px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="py-3 px-4">
                            <h1 class="block py-2 text-center font-medium leading-6 text-gray-900"><strong>Student Lists</strong></h1>
                            </div>
                            <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Student Name</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Email Address</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Parent Phone Number</th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($students as $student)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $student->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $student->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $student->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Delete</button>
                                        </form>                                                        
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            <div class="py-1 px-4">
                            <nav class="flex items-center space-x-1 justify-end">
                                {{ $students->links() }}
                            </nav>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
