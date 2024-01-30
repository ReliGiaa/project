<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Karyawan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form id="myForm" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label for="nama_lengkap" class="form-label ">Nama Lengkap</label>
                        <input type="text" class="form-control rounded" id="nama_lengkap" name="nama_lengkap" value="{{ $karyawan->nama_lengkap }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nomor_induk_karyawan" class="form-label">Nomor Induk Karyawan</label>
                        <input type="text" class="form-control rounded" id="nomor_induk_karyawan" name="nomor_induk_karyawan" value="{{ $karyawan->nomor_induk_karyawan }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control rounded" id="alamat" name="alamat" value="{{ $karyawan->alamat }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cabang" class="form-label">Cabang</label>
                        <select class="form-control rounded" id="cabang" name="cabang" required>
                        <option {{ $karyawan->cabang == 'bandung' ? 'selected' : '' }} value="bandung">Bandung</option>
                            <option {{ $karyawan->cabang == 'garut' ? 'selected' : '' }} value="garut">Garut</option>
                            <option {{ $karyawan->cabang == 'sukabumi' ? 'selected' : '' }} value="sukabumi">Sukabumi</option>
                            <option {{ $karyawan->cabang == 'cianjur' ? 'selected' : '' }} value="cianjur">Cianjur</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="organisasi" class="form-label">Organisasi</label>
                        <select class="form-control rounded" id="organisasi" name="organisasi" required>
                            <option {{ $karyawan->organisasi == 'operational' ? 'selected' : '' }} value="operational">Operational</option>
                            <option {{ $karyawan->organisasi == 'supporting' ? 'selected' : '' }} value="supporting">Supporting</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-control rounded" id="jabatan" name="jabatan" required>
                            <option {{ $karyawan->jabatan == 'staffit' ? 'selected' : '' }} value="staffit">Staff IT</option>
                            <option {{ $karyawan->jabatan == 'spvit' ? 'selected' : '' }} value="spvit">SPV IT</option>
                            <option {{ $karyawan->jabatan == 'managerit' ? 'selected' : '' }} value="managerit">Manager IT</option>
                            <option {{ $karyawan->jabatan == 'dirum' ? 'selected' : '' }} value="dirum">Direktur Umum</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="level_jabatan" class="form-label">Level Jabatan</label>
                        <select class="form-control rounded" id="level_jabatan" name="level_jabatan" required>
                            <option {{ $karyawan->level_jabatan == 'staff' ? 'selected' : '' }} value="staff">Staff</option>
                            <option {{ $karyawan->level_jabatan == 'spv' ? 'selected' : '' }} value="spv">SPV</option>
                            <option {{ $karyawan->level_jabatan == 'manager' ? 'selected' : '' }} value="manager">Manager</option>
                            <option {{ $karyawan->level_jabatan == 'direktur' ? 'selected' : '' }} value="direktur">Direktur</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="id_user" class="form-label">Id User</label>
                        <select class="form-control rounded" id="id_user" name="id_user" required>
                        @foreach($users as $user)
                            <option {{ $karyawan->id_user == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label for="id" class="form-label" style="display: none;">ID</label>
                        <input type="hidden" class="form-control rounded" id="id" name="id" value="{{ $karyawan->id }}" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Edit</button>
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
                    url: '/api/karyawans/' + $('#id').val(), 
                    type: 'PUT',
                    data: {
                        nama_lengkap: $('#nama_lengkap').val(),
                        nomor_induk_karyawan: $('#nomor_induk_karyawan').val(),
                        alamat: $('#alamat').val(),
                        cabang: $('#cabang').val(),
                        organisasi: $('#organisasi').val(),
                        jabatan: $('#jabatan').val(),
                        level_jabatan: $('#level_jabatan').val(),
                        id_user: $('#id_user').val(),
                        id: $('#id').val(),
                    },
                    success: function(response) {
                        // Redirect to dashboard
                        window.location.href = '/dashboard';
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseJSON);
                    }
                });
            });
        });
    </script>