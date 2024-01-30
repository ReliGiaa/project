<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Karyawan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form id="myForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 ">
                    <div class="col-md-6 mb-3">
                        <label for="import_karyawan" class="form-label ">Import File Excel</label>
                        <input type="file" class="form-control rounded" id="import_karyawan" name="import_karyawan" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Import</button>
            </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '/api/karyawans', // Change this to your API endpoint
                    type: 'POST',
                    data: JSON.stringify({
                        nama_lengkap: $('#nama_lengkap').val(),
                        nomor_induk_karyawan: $('#nomor_induk_karyawan').val(),
                        alamat: $('#alamat').val(),
                        cabang: $('#cabang').val(),
                        organisasi: $('#organisasi').val(),
                        jabatan: $('#jabatan').val(),
                        level_jabatan: $('#level_jabatan').val(),
                        id_user: $('#id_user').val(),
                    }),
                    contentType: 'application/json',
                    success: function(response) {
                    // Redirect to dashboard
                    window.location.href = '/dashboard';
                    }, 
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error here
                        console.log(jqXHR, textStatus, errorThrown);
                    }
                });
            });
        });
    </script>