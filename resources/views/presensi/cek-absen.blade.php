<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            List Presensi Absen < 3
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."> -->
                    <table id="presensi-table" class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>ID Karyawan</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Absen</th>
                        </tr>
                    </thead>
                    <tbody id="presensi-table-body">
                        <!-- Data will be inserted here using JavaScript -->
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Fetch the data from the API
    fetch('/api/lebih-3')
        .then(response => response.json())
        .then(data => {
            console.log('Fetched data:', data); // Log the fetched data

            // Get the table body element
            const tableBody = document.getElementById('presensi-table-body');

            // Create an object to store the dates and names for each employee
            const employees = {};

            // Iterate over each presensi record
            data.data.forEach(presensi => {
                // If this employee already has dates stored, append the new date
                if (employees[presensi.id_karyawan]) {
                    employees[presensi.id_karyawan].dates.push(presensi.tanggal);
                } else {
                    // Otherwise, initialize a new object with the date and name
                    employees[presensi.id_karyawan] = {
                        name: presensi.nama_lengkap, // Use nama_lengkap instead of nama_karyawan
                        dates: [presensi.tanggal]
                    };
                }
            });

            console.log('Employees:', employees); // Log the employees object

            // Iterate over each employee in the employees object
            for (const id_karyawan in employees) {
                console.log('Processing id_karyawan:', id_karyawan); // Log the id_karyawan

                // Create a new table row for this employee
                const row = document.createElement('tr');

                // Create the ID cell and set its text
                const idCell = document.createElement('td');
                idCell.textContent = id_karyawan;
                row.appendChild(idCell);

                // Create the name cell and set its text
                const nameCell = document.createElement('td');
                nameCell.textContent = employees[id_karyawan].name;
                row.appendChild(nameCell);

                // Create the date cell and set its text to the joined dates
                const dateCell = document.createElement('td');
                dateCell.textContent = employees[id_karyawan].dates.join(' / ');
                row.appendChild(dateCell);

                // Append the row to the table body
                tableBody.appendChild(row);
            }
        });
</script>