@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto Kegiatan')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-lg font-extrabold text-slate-800 tracking-tight">Dokumentasi Galeri Foto</h2>
        <p class="text-xs text-slate-400 mt-0.5">Dokumentasi momen kegiatan dan pembangunan desa.</p>
    </div>
    <button onclick="openGaleriModal('create')" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
        <i class="ti ti-plus text-base"></i>
        <span>Upload Foto Baru</span>
    </button>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4">Judul Dokumentasi</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($galeris as $g)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden border border-slate-200">
                            @if($g->foto)
                                <img src="{{ asset('storage/' . $g->foto) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400"><i class="ti ti-photo"></i></div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $g->judul }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-700">
                            {{ $g->kategori }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500">{{ $g->tanggal ? $g->tanggal->translatedFormat('d/m/Y') : '-' }}</td>
                    <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                        <button onclick='openGaleriModal("edit", @json($g))' class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </button>
                        <form action="{{ route('admin.galeri.destroy', ['galeri' => $g->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus dokumentasi foto ini?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-bold text-[11px] transition-colors">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada dokumentasi foto galeri.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $galeris->links() }}</div>

<!-- Modal Form Input Galeri Foto -->
<div id="modal-galeri" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden animate-fadeIn overflow-y-auto">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-lg w-full p-6 md:p-8 space-y-6 relative" onclick="event.stopPropagation()">
        <button onclick="closeGaleriModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <div class="border-b border-slate-100 pb-4">
            <h3 id="modal-galeri-title" class="text-lg font-extrabold text-slate-800">Form Galeri Foto</h3>
            <p class="text-xs text-slate-400 mt-0.5">Unggah dokumentasi foto kegiatan atau pembangunan.</p>
        </div>

        <form id="form-galeri" method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" id="galeri-method" name="_method" value="POST">

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Judul Foto Dokumentasi <span class="text-red-500">*</span></label>
                <input type="text" id="gl_judul" name="judul" required placeholder="Judul momen foto..."
                       class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Kategori Foto</label>
                    <input type="text" id="gl_kategori" name="kategori" placeholder="Kegiatan / Pembangunan"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Tanggal Dokumentasi</label>
                    <input type="date" id="gl_tanggal" name="tanggal"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">File Foto Dokumentasi</label>
                <input type="file" name="foto" accept="image/*"
                       class="w-full border border-slate-200 rounded-2xl p-2.5 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Momen Foto</label>
                <textarea id="gl_deskripsi" name="deskripsi" rows="3" placeholder="Keterangan singkat momen foto..."
                          class="w-full border border-slate-200 rounded-2xl p-3 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeGaleriModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-2.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] transition-all">
                    Simpan Foto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openGaleriModal(mode, data = null) {
    const form = document.getElementById('form-galeri');
    const methodInput = document.getElementById('galeri-method');
    const title = document.getElementById('modal-galeri-title');

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Foto: ' + data.judul;
        form.action = "{{ route('admin.galeri.update', ['galeri' => ':id']) }}".replace(':id', data.id);
        methodInput.value = 'PUT';

        document.getElementById('gl_judul').value = data.judul || '';
        document.getElementById('gl_kategori').value = data.kategori || 'Kegiatan';
        document.getElementById('gl_tanggal').value = data.tanggal ? data.tanggal.substring(0, 10) : '';
        document.getElementById('gl_deskripsi').value = data.deskripsi || '';
    } else {
        title.innerText = 'Upload Foto Dokumentasi Baru';
        form.action = "{{ route('admin.galeri.store') }}";
        methodInput.value = 'POST';
        form.reset();
    }

    document.getElementById('modal-galeri').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeGaleriModal() {
    document.getElementById('modal-galeri').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
@endsection

