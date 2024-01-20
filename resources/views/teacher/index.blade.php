<x-teacher-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Hi {{ Auth::user()->name }}, you are logged in as a teacher!
                </div>
            </div>
        </div>
    </div>
</x-teacher-layout>
