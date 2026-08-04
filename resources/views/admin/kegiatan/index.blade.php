@extends('layouts.admin')

@section('title', 'Kelola Agenda Kegiatan Desa')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-lg font-extrabold text-slate-800 tracking-tight">Agenda & Kalender Kegiatan</h2>
        <p class="text-xs text-slate-400 mt-0.5">Jadwal kegiatan kemasyarakatan dan pelayanan desa.</p>
    </div>
    <button onclick="openKegiatanModal('create')" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
        <i class="ti ti-plus text-base"></i>
        <span>Tambah Agenda</span>
    </button>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Nama Kegiatan</th>
                    <th class="px-6 py-4">Tanggal & Waktu</th>
                    <th class="px-6 py-4">Lokasi</th>
                    <th class="px-6 py-4">Penyelenggara</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($kegiatans as $k)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $k->nama_kegiatan }}</td>
                    <td class="px-6 py-4 text-slate-600 font-semibold">{{ $k->tanggal->translatedFormat('d F Y') }} {{ $k->waktu ? '('.$k->waktu.')' : '' }}</td>
                    <td class="px-6 py-4">{{ $k->lokasi ?: '-' }}</td>
                    <td class="px-6 py-4">{{ $k->penyelenggara ?: '-' }}</td>
                    <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                        <button onclick='openKegiatanModal("edit", @json($k))' class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </button>
                        <form action="{{ route('admin.kegiatan.destroy', ['kegiatan' => $k->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus agenda kegiatan ini?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-bold text-[11px] transition-colors">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada agenda kegiatan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $kegiatans->links() }}</div>

<!-- Modal Form Input Kegiatan -->
<div id="modal-kegiatan" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden animate-fadeIn">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-lg w-full p-6 md:p-8 space-y-6 relative" onclick="event.stopPropagation()">
        <button onclick="closeKegiatanModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <div class="border-b border-slate-100 pb-4">
            <h3 id="modal-kegiatan-title" class="text-lg font-extrabold text-slate-800">Form Agenda Kegiatan</h3>
            <p class="text-xs text-slate-400 mt-0.5">Jadwal musyawarah, gotong royong, atau pelayanan desa.</p>
        </div>

        <form id="form-kegiatan" method="POST" action="{{ route('admin.kegiatan.store') }}" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" id="kegiatan-method" name="_method" value="POST">

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Kegiatan <span class="text-red-500">*</span></label>
                <input type="text" id="kg_nama" name="nama_kegiatan" required placeholder="Contoh: Musrenbangdes 2026"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="kg_tanggal" name="tanggal" required
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Waktu Pelaksanaan</label>
                    <input type="text" id="kg_waktu" name="waktu" placeholder="08:00 - Selesai"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Lokasi Tempat</label>
                    <input type="text" id="kg_lokasi" name="lokasi" placeholder="Balai Desa / RW 02"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Penyelenggara</label>
                    <input type="text" id="kg_penyelenggara" name="penyelenggara" placeholder="Pemdes / Karang Taruna"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Kegiatan</label>
                <textarea id="kg_deskripsi" name="deskripsi" rows="3" placeholder="Keterangan agenda kegiatan..."
                          class="w-full border border-slate-200 rounded-2xl p-3 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeKegiatanModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-2.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] transition-all">
                    Simpan Agenda
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openKegiatanModal(mode, data = null) {
    const form = document.getElementById('form-kegiatan');
    const methodInput = document.getElementById('kegiatan-method');
    const title = document.getElementById('modal-kegiatan-title');

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Agenda: ' + data.nama_kegiatan;
        form.action = "{{ route('admin.kegiatan.update', ['kegiatan' => ':id']) }}".replace(':id', data.id);
        methodInput.value = 'PUT';

        document.getElementById('kg_nama').value = data.nama_kegiatan || '';
        document.getElementById('kg_tanggal').value = data.tanggal ? data.tanggal.substring(0, 10) : '';
        document.getElementById('kg_waktu').value = data.waktu || '';
        document.getElementById('kg_lokasi').value = data.lokasi || '';
        document.getElementById('kg_penyelenggara').value = data.penyelenggara || '';
        document.getElementById('kg_deskripsi').value = data.deskripsi || '';
    } else {
        title.innerText = 'Tambah Agenda Kegiatan Baru';
        form.action = "{{ route('admin.kegiatan.store') }}";
        methodInput.value = 'POST';
        form.reset();
    }

    document.getElementById('modal-kegiatan').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeKegiatanModal() {
    document.getElementById('modal-kegiatan').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
@endsection

