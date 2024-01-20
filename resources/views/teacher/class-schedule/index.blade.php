<x-teacher-layout>
    <div class="py-12 w-full block">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="w-full px-2">
                <h1 class="block py-2 text-x font-medium leading-6 text-gray-900"><strong>Create Schedule</strong></h1>
                    <form method="POST" action="{{ route('teacher.class-schedule.store') }}">
                        @csrf
                        <div class="block mt-1">
                            <x-input-label for="name" :value="__('Select Class Name')" />
                            <select id="class_id" name="class_id" class="block mt-1 w-full sm:rounded-lg" required autofocus autocomplete="class_id">
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                            </select>   
                        </div>
                        <div class="block mt-1">
                            <x-input-label for="name" :value="__('Select Subject')" />
                            <select id="subject_id" name="subject_id" class="block mt-1 w-full sm:rounded-lg" required autofocus autocomplete="subject_id">                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                            </select>   
                        </div>     
                        <div>
                            <label for="date">Date</label>
                            <input id="date" class="block mt-1 w-full sm:rounded-lg" type="date" name="date" required>
                        </div>
                        <div>
                            <label for="start_time">Start Time</label>
                            <input id="start_time" class="block mt-1 w-full sm:rounded-lg" type="time" name="start_time" required>
                        </div>
                        <div>
                            <label for="end_time">End Time</label>
                            <input id="end_time" class="block mt-1 w-full sm:rounded-lg" type="time" name="end_time" required>
                        </div>
                        <div class="block mt-6 flex items-center justify-end gap-x-6">
                            <button type="reset" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                            <x-primary-button class="ms-4">
                                {{ __('Create Schedule') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 w-full block">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="w-full px-2">
                <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="py-3 px-4">
                            <h1 class="block py-2 text-center text-xl font-medium leading-6 text-gray-900"><strong>My Schedules</strong></h1>
                            </div>
                            <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Class Name</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Subjects</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Dates</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Start Time</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">End Time</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($schedules as $schedule)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $schedule->class_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $schedule->subject_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $schedule->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $schedule->start_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $schedule->end_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <div class="flex justify-center">
                                        <form action="{{ route('teacher.class-schedule.destroy', $schedule->id) }}" method="POST">     
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Delete</button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach    
                                </tbody>
                            </table>
                            </div>
                            <div class="py-1 px-4">
                            <nav class="flex items-center space-x-1 justify-end">
                                
                            </nav>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>