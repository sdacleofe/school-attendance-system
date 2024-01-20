<x-student-layout>
<div class="py-12 w-full block">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="w-full px-2 text-center">
                <h1><strong>YOUR QR CODE</strong></h1>
                <br />
                <div style="display: flex; justify-content: center;">
                    {!! $qrCode !!}
                </div>
                <br />
                <p>Use this QR code for attendance.</p>
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
                    <h1 class="block py-2 text-center text-xl font-medium leading-6 text-gray-900"><strong>Take Attendance</strong></h1>
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
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Action</th>                                
                        </tr>
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
                                <form action="#" method="POST">     
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-yellow-600 hover:text-yellow-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">SCAN</button>                                </form>
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
<div class="py-12 w-full block">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="w-full px-2 text-center">
            <h1 class="text-center text-xl mt-5"><strong>Scan QR Code</strong></h1>
                <div class="flex justify-center">";
                    <video id="preview" style="width: 500px; height: 500px;"></video>
                </div>

                <script type="text/javascript">
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                
                scanner.addListener('scan', function (content) {
                    console.log(content);
                    
                    var url = window.location.origin + '/api/attendance/' + content;
                    console.log(url);

                    // Stop the scanner after a QR code has been scanned
                    scanner.stop();
                });
                
                Instascan.Camera.getCameras().then(function (cameras) {
                    if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    } else {
                    console.error('No cameras found.');
                    }
                }).catch(function (e) {
                    console.error(e);
                });
                </script>
            </div>
        </div>
    </div>
</div>
</x-student-layout>