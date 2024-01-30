<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Presensi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form id="presensiForm" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                <div class="col-md-12 mb-3">
                        <label for="id_karyawan" class="form-label">Karyawan</label>
                        <select class="form-control rounded" id="id_karyawan" name="id_karyawan" required>
                            @foreach($karyawans as $karyawan)
                                <option {{ $presensi->id_karyawan == $karyawan->id ? 'selected' : '' }} value="{{ $presensi->id}}">{{ $karyawan->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label ">Tanggal</label>
                        <input type="date" class="form-control rounded" id="tanggal" name="tanggal" value="{{ $presensi->tanggal }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control rounded" id="jam_masuk" name="jam_masuk" value="{{ $presensi->jam_masuk }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="jam_pulang" class="form-label">Jam Pulang</label>
                        <input type="time" class="form-control rounded" id="jam_pulang" name="jam_pulang" value="{{ $presensi->jam_pulang }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                    <label for="presensi_status" class="form-label">Presensi Status</label>
                    <select class="form-control rounded" id="presensi_status" name="presensi_status" required>
                        <option value="Datang_Awal" {{ $presensi->presensi_status == 'Datang_Awal' ? 'selected' : '' }}>Datang Awal</option>
                        <option value="Tepat_Waktu" {{ $presensi->presensi_status == 'Tepat_Waktu' ? 'selected' : '' }}>Tepat Waktu</option>
                        <option value="Terlambat" {{ $presensi->presensi_status == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="Absen" {{ $presensi->presensi_status == 'Absen' ? 'selected' : '' }}>Absen</option>
                        <option value="Izin" {{ $presensi->presensi_status == 'Izin' ? 'selected' : '' }}>Izin</option>
                        <option value="Sakit" {{ $presensi->presensi_status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    </select>
                    </div>
                    <div class="col mb-3">
                        <label for="id" class="form-label" style="display: none;">ID</label>
                        <input type="hidden" class="form-control rounded" id="id" name="id" value="{{ $presensi->id }}" readonly>
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
            $('#presensiForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '/api/presensis/' + $('#id').val(), 
                    type: 'PUT',
                    data: {
                        id_karyawan: $('#id_karyawan').val(),
                        tanggal: $('#tanggal').val(),
                        jam_masuk: $('#jam_masuk').val(),
                        jam_pulang: $('#jam_pulang').val(),
                        presensi_status: $('#presensi_status').val(),
                        id: $('#id').val()
                    },
                    success: function(response) {
                        // Redirect to dashboard
                        window.location.href = '/dashboardpresen';
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseJSON);
                    }
                });
            });
        });
    </script>