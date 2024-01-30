<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Presensi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form id="presensiForm" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        <label for="id_karyawan" class="form-label">Karyawan</label>
                        <select class="form-control rounded" id="id_karyawan" name="id_karyawan" required>
                            <option selected>Pilih</option>
                            @foreach($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label ">Tanggal</label>
                        <input type="date" class="form-control rounded" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control rounded" id="jam_masuk" name="jam_masuk" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="jam_pulang" class="form-label">Jam Pulang</label>
                        <input type="time" class="form-control rounded" id="jam_pulang" name="jam_pulang" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="presensi_status" class="form-label">Presensi Status</label>
                        <select class="form-control rounded" id="presensi_status" name="presensi_status" required>
                            <option selected>Pilih</option>
                            <option value="Datang_Awal">Datang Awal</option>
                            <option value="Tepat_Waktu">Tepat Waktu</option>
                            <option value="Terlambat">Terlambat</option>
                            <option value="Absen">Absen</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Libur">Libur</option>
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
            $('#presensiForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '/api/presensis', 
                    type: 'POST',
                    data: JSON.stringify({
                        id_karyawan: $('#id_karyawan').val(),
                        tanggal: $('#tanggal').val(),
                        jam_masuk: $('#jam_masuk').val(),
                        jam_pulang: $('#jam_pulang').val(),
                        presensi_status: $('#presensi_status').val(),
                    }),
                    contentType: 'application/json',
                    success: function(response) {
                    // Redirect to dashboard
                    window.location.href = '/dashboardpresen';
                    }, 
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error here
                        console.log(jqXHR, textStatus, errorThrown);
                    }
                });
            });
        });
    </script>