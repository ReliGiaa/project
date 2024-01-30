<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            List Karyawan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 button-container">
                        <a href="/karyawan/create" id="add-employee-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                            Add Employee
                        </a>
                        <a href="/karyawan/export_excel" id="add-employee-btn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">
                            Export Excel
                        </a>
                        <!-- <a href="/karyawan/import" id="add-employee-btn" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded ml-2">
                            Import Excel
                        </a> -->
                    </div>
                    
                    <input type="text" id="filter" placeholder="Type to search...">
                    <table id="data-table" class="table table-sm table-bordered">
                        <thead>
                            <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">ID</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Nama Lengkap</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Nomor Induk Karyawan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Alamat</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Cabang</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Organisasi</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Jabatan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Level Jabatan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">ID User</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $.ajax({
        url: 'http://localhost:8000/api/karyawans',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $.each(data.data, function(key, value){
                var row = $('<tr>').addClass('border');
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.id));
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.nama_lengkap)); 
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.nomor_induk_karyawan));
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.alamat)); 
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.cabang));
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.organisasi));
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.jabatan));
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.level_jabatan));
                row.append($('<td>').addClass('px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 border').text(value.id_user));
                // Add action buttons
                var actionButton = $('<td>').addClass('px-6 py-4 whitespace-nowrap text-center text-sm font-medium');
                var editLink = $('<a>').addClass('text-indigo-600 hover:text-indigo-900 mr-3').attr('href', '/karyawan/edit/' + value.id);
                var editIcon = $('<i>').addClass('bi bi-pencil-square');
                editLink.append(editIcon);
                var deleteLink = $('<a>').addClass('text-red-600 hover:text-red-900 deleteBtn').attr('href', '/karyawan/destroy/' + value.id).attr('data-id', value.id);
                var deleteIcon = $('<i>').addClass('bi bi-trash');
                deleteLink.append(deleteIcon);
                actionButton.append(editLink);
                actionButton.append(deleteLink);
                row.append(actionButton);
                $('#data-table tbody').append(row);
            });
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });

    $('.deleteBtn').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/karyawan/destroy/' + id,
        type: 'DELETE',
        success: function(response) {
                // Reload the page
                location.reload();
            },
        error: function(response) {
            console.log('Error:', response);
        }
        });
    });

    $("#filter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#data-table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>