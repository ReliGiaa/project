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
                <form id="myForm" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="nama_lengkap" class="form-label ">Nama Lengkap</label>
                        <input type="text" class="form-control rounded" id="nama_lengkap" name="nama_lengkap" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nomor_induk_karyawan" class="form-label">Nomor Induk Karyawan</label>
                        <input type="text" class="form-control rounded" id="nomor_induk_karyawan" name="nomor_induk_karyawan" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control rounded" id="alamat" name="alamat" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cabang" class="form-label">Cabang</label>
                        <select class="form-control rounded" id="cabang" name="cabang" required>
                            <option selected>Pilih</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Garut">Garut</option>
                            <option value="Sukabumi">Sukabumi</option>
                            <option value="Cianjur">Cianjur</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="organisasi" class="form-label">Organisasi</label>
                        <select class="form-control rounded" id="organisasi" name="organisasi" required>
                            <option selected>Pilih</option>
                            <option value="Operational">Operational</option>
                            <option value="Supporting">Supporting</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-control rounded" id="jabatan" name="jabatan" required>
                            <option selected>Pilih</option>
                            <option value="Staff_IT">Staff IT</option>
                            <option value="SPV_IT">SPV IT</option>
                            <option value="Manager_IT">Manager IT</option>
                            <option value="Direktur_Umum">Direktur Umum</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="level_jabatan" class="form-label">Level Jabatan</label>
                        <select class="form-control rounded" id="level_jabatan" name="level_jabatan" required>
                            <option selected>Pilih</option>
                            <option value="Staff">Staff</option>
                            <option value="Spv">SPV</option>
                            <option value="Manager">Manager</option>
                            <option value="Direktur">Direktur</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="id_user" class="form-label">Id User</label>
                        <select class="form-control rounded" id="id_user" name="id_user" required>
                            <option selected>Pilih</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
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