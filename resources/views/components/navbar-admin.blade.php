@props(['name'])

<div class="bg-gray-300 py-2 px-4 d-flex align-items-center justify-content-between">
    <span class="fw-bold fs-5">{{ getCurrentTimeOfDay($name) }}</span>
    <div class="btn-group d-none d-sm-block">
        <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">        {{ $name }}
        </button>
        <ul class="dropdown-menu">
            <li>
                <div class="dropdown-item">
                    <form method="POST" class="w-100"
                        action="{{ Auth::user()->hasRole('admin') ? route('admin.logout') : route('karyawan.logout') }}">
                        @csrf
                        <span class="btn btn-sm w-100"
                            onclick="event.preventDefault(); this.closest('form').submit();">Log Out</span>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="w-100 bg-primary px-2 d-sm-none position-relative d-flex justify-content-between align-items-center"
    style="height: 50px;">
    <button type="button" class="btn text-white btn-menu">
        <i class="fa-solid fa-bars fa-xl"></i>
    </button>
    <form method="POST"
        action="{{ Auth::user()->hasRole('admin') ? route('admin.logout') : route('karyawan.logout') }}">
        @csrf
        <button type="submit" class="btn text-white">
            <i class="fa-solid fa-arrow-right-from-bracket fa-xl"></i>
        </button>
    </form>
    <div class="mobile-menu bg-primary">
        <ul class="w-100 d-flex flex-column gap-2 list-menu-mb justify-content-center align-items-center py-3">
            @if (Auth::user()->hasRole('admin'))
            <li>
                <a href="{{ route('admin.dashboard') }}" class="item-list-menu-mb">
                    Halaman Utama
                </a>
            </li>
            <li>
                <a href="{{ route('admin.karyawan') }}"  class="item-list-menu-mb">
                    Data Karyawan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.absen.riwayat') }}" class="item-list-menu-mb">
                    Data Absensi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.karyawan.jadwal') }}" class="item-list-menu-mb">
                    Jadwal Karyawan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.history') }}"  class="item-list-menu-mb">
                    Riwayat Jadwal
                </a>
            </li>
            <li>
                <a href="{{ route('admin.penggajian') }}"  class="item-list-menu-mb">
                    Penggajian
                </a>
            </li>
            <li>
                <a href="{{ route('admin.gaji.riwayat') }}" class="item-list-menu-mb">
                    Riwayat Gaji
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ijin') }}" class="item-list-menu-mb">
                    Riwayat Izin
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profile') }}"  class="item-list-menu-mb">
                    Kelola Akun
                </a>
            </li>
            @endif

            @if (Auth::user()->hasRole('karyawan'))
                <li><a href="{{ route('karyawan.dashboard') }}" class="item-list-menu-mb">Halaman Utama</a></li>
                <li><a href="{{ route('karyawan.absen.view') }}" class="item-list-menu-mb">Absensi Karyawan</a></li>
                <li><a href="{{ route('karyawan.absen.riwayat') }}" class="item-list-menu-mb">Riwayat Absensi</a></li>
                <li><a href="{{ route('karyawan.jadwal.riwayat') }}" class="item-list-menu-mb">Riwayat Jadwal</a></li>
                <li><a href="{{ route('karyawan.gaji.riwayat') }}" class="item-list-menu-mb">Riwayat Gaji</a></li>
                <li><a href="{{ route('karyawan.ijin.view') }}" class="item-list-menu-mb">Pengajuan Izin</a></li>
                <li><a href="{{ route('karyawan.ijin.riwayat') }}" class="item-list-menu-mb">Riwayat Izin</a></li>
                <li><a href="{{ route('karyawan.profile') }}" class="item-list-menu-mb">Kelola Akun</a></li>
            @endif
        </ul>
    </div>
</div>
<div class="container-fluid px-md-4">
    {{ $slot }}
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-menu').on('click', function() {
                $('.mobile-menu').toggleClass('active');
            });
        });
    </script>
@endpush
