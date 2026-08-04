@extends('layouts.admin')

@section('title', 'Data Penduduk')

@section('content')

<!-- Header Action & Tabs -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
    <!-- Sub-navigation Tabs -->
    <div class="flex items-center gap-2 bg-slate-200/60 p-1.5 rounded-2xl w-full sm:w-auto text-xs font-bold">
        <a href="{{ route('admin.penduduk.index') }}" class="px-5 py-2.5 rounded-xl bg-white text-emerald-800 shadow-sm transition-all">
            <i class="ti ti-users"></i> Data Per Orang
        </a>
        <a href="{{ route('admin.penduduk.kk') }}" class="px-5 py-2.5 rounded-xl text-slate-600 hover:text-slate-900 transition-all">
            <i class="ti ti-id-badge-2"></i> Data Kartu Keluarga (KK)
        </a>
    </div>

    <button onclick="openPendudukModal('create')" class="w-full sm:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
        <i class="ti ti-user-plus text-base"></i>
        <span>Tambah Data Penduduk</span>
    </button>
</div>

<!-- Filter Bar -->
<form method="GET" class="bg-white p-4 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/30 flex flex-wrap gap-3 mb-8 text-xs">
    <div class="relative flex-grow min-w-[200px]">
        <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-base"></i>
        <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama / NIK / No. KK..."
               class="w-full border border-slate-200 rounded-2xl pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
    </div>
    
    <div class="relative w-36">
        <select name="jenis_kelamin" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 appearance-none cursor-pointer">
            <option value="">Semua Gender</option>
            <option value="Laki-laki" {{ request('jenis_kelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ request('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        <i class="ti ti-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
    </div>

    <div class="relative w-28">
        <select name="rt" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 appearance-none cursor-pointer">
            <option value="">Semua RT</option>
            @foreach($rtList as $rt)
                <option value="{{ $rt }}" {{ request('rt') == $rt ? 'selected' : '' }}>RT {{ $rt }}</option>
            @endforeach
        </select>
        <i class="ti ti-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
    </div>

    <div class="relative w-28">
        <select name="rw" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 appearance-none cursor-pointer">
            <option value="">Semua RW</option>
            @foreach($rwList as $rw)
                <option value="{{ $rw }}" {{ request('rw') == $rw ? 'selected' : '' }}>RW {{ $rw }}</option>
            @endforeach
        </select>
        <i class="ti ti-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
    </div>

    <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-2.5 rounded-2xl transition-colors flex items-center gap-1.5">
        <i class="ti ti-filter"></i> Filter
    </button>
</form>

<!-- Table Card -->
<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">NIK</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Jenis Kelamin</th>
                    <th class="px-6 py-4">Alamat RT/RW</th>
                    <th class="px-6 py-4">Pekerjaan</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($penduduks as $p)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-mono font-bold text-slate-800">{{ $p->nik }}</td>
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $p->nama }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $p->jenis_kelamin === 'Laki-laki' ? 'bg-blue-50 text-blue-700' : 'bg-pink-50 text-pink-700' }}">
                            {{ $p->jenis_kelamin }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500">RT {{ $p->rt }}/RW {{ $p->rw }}, {{ \Illuminate\Support\Str::limit($p->alamat, 30) }}</td>
                    <td class="px-6 py-4">{{ $p->pekerjaan ?: '-' }}</td>
                    <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                        <a href="{{ route('admin.penduduk.show', $p) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-teal-50 text-slate-600 hover:text-teal-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-eye"></i> Detail
                        </a>
                        <button onclick='openPendudukModal("edit", @json($p))' class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </button>
                        <form action="{{ route('admin.penduduk.destroy', ['penduduk' => $p->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data {{ $p->nama }}?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-bold text-[11px] transition-colors">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400">Belum ada data penduduk yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $penduduks->links() }}</div>

<!-- Modal Form Input Penduduk -->
<div id="modal-penduduk" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden animate-fadeIn overflow-y-auto">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-2xl w-full my-8 p-6 md:p-8 space-y-6 relative" onclick="event.stopPropagation()">
        <button onclick="closePendudukModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <div class="border-b border-slate-100 pb-4">
            <h3 id="modal-penduduk-title" class="text-lg font-extrabold text-slate-800">Form Penduduk</h3>
            <p class="text-xs text-slate-400 mt-0.5">Isi seluruh data demografis penduduk di bawah ini.</p>
        </div>

        <form id="form-penduduk" method="POST" action="{{ route('admin.penduduk.store') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" id="penduduk-method" name="_method" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">NIK (16 Digit) <span class="text-red-500">*</span></label>
                    <input type="text" id="p_nik" name="nik" required maxlength="16" placeholder="NIK 16 angka"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nomor KK (16 Digit)</label>
                    <input type="text" id="p_no_kk" name="no_kk" maxlength="16" placeholder="Nomor KK 16 angka"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="p_nama" name="nama" required placeholder="Nama lengkap warga"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select id="p_jk" name="jenis_kelamin" required class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Tempat Lahir</label>
                    <input type="text" id="p_tempat_lahir" name="tempat_lahir" placeholder="Kota lahir"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Tanggal Lahir</label>
                    <input type="date" id="p_tanggal_lahir" name="tanggal_lahir"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Agama</label>
                    <input type="text" id="p_agama" name="agama" placeholder="Agama"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Status Perkawinan</label>
                    <input type="text" id="p_status_perkawinan" name="status_perkawinan" placeholder="Kawin/Belum Kawin"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pekerjaan</label>
                    <input type="text" id="p_pekerjaan" name="pekerjaan" placeholder="Pekerjaan"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">RT</label>
                    <input type="text" id="p_rt" name="rt" placeholder="001"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">RW</label>
                    <input type="text" id="p_rw" name="rw" placeholder="002"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Pendidikan Terakhir</label>
                    <input type="text" id="p_pendidikan" name="pendidikan_terakhir" placeholder="SMA/S1..."
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Alamat Rumah</label>
                <textarea id="p_alamat" name="alamat" rows="2" placeholder="Alamat rumah..."
                          class="w-full border border-slate-200 rounded-2xl p-3 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closePendudukModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-2.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] transition-all">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openPendudukModal(mode, data = null) {
    const form = document.getElementById('form-penduduk');
    const methodInput = document.getElementById('penduduk-method');
    const title = document.getElementById('modal-penduduk-title');

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Data Penduduk: ' + data.nama;
        form.action = "{{ route('admin.penduduk.update', ['penduduk' => ':id']) }}".replace(':id', data.id);
        methodInput.value = 'PUT';

        document.getElementById('p_nik').value = data.nik || '';
        document.getElementById('p_no_kk').value = data.no_kk || '';
        document.getElementById('p_nama').value = data.nama || '';
        document.getElementById('p_jk').value = data.jenis_kelamin || 'Laki-laki';
        document.getElementById('p_tempat_lahir').value = data.tempat_lahir || '';
        document.getElementById('p_tanggal_lahir').value = data.tanggal_lahir ? data.tanggal_lahir.substring(0, 10) : '';
        document.getElementById('p_agama').value = data.agama || '';
        document.getElementById('p_status_perkawinan').value = data.status_perkawinan || '';
        document.getElementById('p_pekerjaan').value = data.pekerjaan || '';
        document.getElementById('p_rt').value = data.rt || '';
        document.getElementById('p_rw').value = data.rw || '';
        document.getElementById('p_pendidikan').value = data.pendidikan_terakhir || '';
        document.getElementById('p_alamat').value = data.alamat || '';
    } else {
        title.innerText = 'Tambah Data Penduduk Baru';
        form.action = "{{ route('admin.penduduk.store') }}";
        methodInput.value = 'POST';
        form.reset();
    }

    document.getElementById('modal-penduduk').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePendudukModal() {
    document.getElementById('modal-penduduk').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>

@endsection


