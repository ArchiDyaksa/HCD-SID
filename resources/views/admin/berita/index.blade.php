@extends('layouts.admin')

@section('title', 'Berita Desa')

@section('content')

<!-- Header Action & Search -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
    <form method="GET" class="w-full sm:w-auto flex gap-2">
        <div class="relative flex-grow sm:w-80">
            <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari judul berita..."
                   class="w-full border border-slate-200 rounded-2xl pl-11 pr-4 py-2.5 text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none transition-all">
        </div>
        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl text-xs transition-colors flex items-center gap-1.5">
            <span>Cari</span>
        </button>
    </form>
    
    <button onclick="openBeritaAdminModal('create')" class="w-full sm:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
        <i class="ti ti-edit-circle text-base"></i>
        <span>Tulis Berita Baru</span>
    </button>
</div>

<!-- Table Card -->
<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Judul Berita</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Status Rilis</th>
                    <th class="px-6 py-4">Total Dilihat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($beritas as $b)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-bold text-slate-900 max-w-xs truncate">{{ $b->judul }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-700">
                            {{ $b->kategori }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $b->status === 'terbit' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                            {{ $b->status === 'terbit' ? 'Terbit Publik' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500 font-semibold">{{ number_format($b->dilihat) }} kali</td>
                    <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                        <button onclick='openBeritaAdminModal("edit", @json($b))' class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </button>
                        <form action="{{ route('admin.berita.destroy', ['berita' => $b->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus berita ini?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-bold text-[11px] transition-colors">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada artikel berita yang dipublikasikan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $beritas->links() }}</div>

<!-- Modal Form Input Berita -->
<div id="modal-berita-admin" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden animate-fadeIn overflow-y-auto">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-2xl w-full my-8 p-6 md:p-8 space-y-6 relative" onclick="event.stopPropagation()">
        <button onclick="closeBeritaAdminModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <div class="border-b border-slate-100 pb-4">
            <h3 id="modal-berita-admin-title" class="text-lg font-extrabold text-slate-800">Form Berita Desa</h3>
            <p class="text-xs text-slate-400 mt-0.5">Tuliskan artikel atau pengumuman resmi desa.</p>
        </div>

        <form id="form-berita-admin" method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" id="berita-method" name="_method" value="POST">

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Judul Berita <span class="text-red-500">*</span></label>
                <input type="text" id="b_judul" name="judul" required placeholder="Judul berita..."
                       class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Kategori Berita</label>
                    <input type="text" id="b_kategori" name="kategori" placeholder="Pengumuman / Pembangunan..."
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Penulis / Redaksi</label>
                    <input type="text" id="b_penulis" name="penulis" placeholder="Nama Penulis"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Isi Konten Berita <span class="text-red-500">*</span></label>
                <textarea id="b_konten" name="konten" rows="8" required placeholder="Isi berita lengkap..."
                          class="w-full border border-slate-200 rounded-2xl p-4 font-medium leading-relaxed focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Gambar Sampul Berita</label>
                <input type="file" name="gambar" accept="image/*"
                       class="w-full border border-slate-200 rounded-2xl p-2.5 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Status Publikasi</label>
                <select id="b_status" name="status" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-bold">
                    <option value="terbit">Terbit (Tampil ke Publik)</option>
                    <option value="draft">Draft (Disimpan Internal)</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeBeritaAdminModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-2.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] transition-all">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openBeritaAdminModal(mode, data = null) {
    const form = document.getElementById('form-berita-admin');
    const methodInput = document.getElementById('berita-method');
    const title = document.getElementById('modal-berita-admin-title');

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Berita: ' + data.judul;
        form.action = "{{ route('admin.berita.update', ['berita' => ':id']) }}".replace(':id', data.id);
        methodInput.value = 'PUT';

        document.getElementById('b_judul').value = data.judul || '';
        document.getElementById('b_kategori').value = data.kategori || 'Umum';
        document.getElementById('b_penulis').value = data.penulis || '';
        document.getElementById('b_konten').value = data.konten || '';
        document.getElementById('b_status').value = data.status || 'terbit';
    } else {
        title.innerText = 'Tulis Berita Desa Baru';
        form.action = "{{ route('admin.berita.store') }}";
        methodInput.value = 'POST';
        form.reset();
    }

    document.getElementById('modal-berita-admin').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBeritaAdminModal() {
    document.getElementById('modal-berita-admin').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>

@endsection


