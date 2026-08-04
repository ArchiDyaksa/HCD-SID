@extends('layouts.admin')

@section('title', 'Kelola Kontak Penting & Layanan Darurat')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-lg font-extrabold text-slate-800 tracking-tight">Daftar Kontak Penting</h2>
        <p class="text-xs text-slate-400 mt-0.5">Nomor darurat, perangkat desa, dan fasilitas umum.</p>
    </div>
    <button onclick="openKontakModal('create')" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
        <i class="ti ti-plus text-base"></i>
        <span>Tambah Kontak</span>
    </button>
</div>

<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Nama Kontak / Institusi</th>
                    <th class="px-6 py-4">Jabatan / Peran</th>
                    <th class="px-6 py-4">Nomor Telepon</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($kontaks as $k)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-700">
                            {{ $k->kategori }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $k->nama }}</td>
                    <td class="px-6 py-4">{{ $k->jabatan_peran ?: '-' }}</td>
                    <td class="px-6 py-4 font-mono font-bold text-emerald-800">{{ $k->no_telp }}</td>
                    <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                        <button onclick='openKontakModal("edit", @json($k))' class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </button>
                        <form action="{{ route('admin.kontak.destroy', ['kontak' => $k->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kontak ini?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-bold text-[11px] transition-colors">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">Belum ada kontak penting yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $kontaks->links() }}</div>

<!-- Modal Form Input Kontak -->
<div id="modal-kontak" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden animate-fadeIn">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-lg w-full p-6 md:p-8 space-y-6 relative" onclick="event.stopPropagation()">
        <button onclick="closeKontakModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <div class="border-b border-slate-100 pb-4">
            <h3 id="modal-kontak-title" class="text-lg font-extrabold text-slate-800">Form Kontak Penting</h3>
            <p class="text-xs text-slate-400 mt-0.5">Nomor darurat, perangkat desa, atau fasilitas umum.</p>
        </div>

        <form id="form-kontak" method="POST" action="{{ route('admin.kontak.store') }}" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" id="kontak-method" name="_method" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select id="kt_kategori" name="kategori" required class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-bold">
                        <option value="Layanan Darurat">Layanan Darurat</option>
                        <option value="Perangkat Desa">Perangkat Desa</option>
                        <option value="Fasilitas Umum">Fasilitas Umum</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Kontak <span class="text-red-500">*</span></label>
                    <input type="text" id="kt_nama" name="nama" required placeholder="Contoh: Puskesmas Desa"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Jabatan / Peran</label>
                    <input type="text" id="kt_jabatan" name="jabatan_peran" placeholder="Contoh: Kepala Desa / UGD"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                    <input type="text" id="kt_telp" name="no_telp" required placeholder="081234567890 / 112"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Alamat Kantor / Lokasi</label>
                <textarea id="kt_alamat" name="alamat" rows="2" placeholder="Alamat lokasi..."
                          class="w-full border border-slate-200 rounded-2xl p-3 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeKontakModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-2.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] transition-all">
                    Simpan Kontak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openKontakModal(mode, data = null) {
    const form = document.getElementById('form-kontak');
    const methodInput = document.getElementById('kontak-method');
    const title = document.getElementById('modal-kontak-title');

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Kontak: ' + data.nama;
        form.action = "{{ route('admin.kontak.update', ['kontak' => ':id']) }}".replace(':id', data.id);
        methodInput.value = 'PUT';

        document.getElementById('kt_kategori').value = data.kategori || 'Layanan Darurat';
        document.getElementById('kt_nama').value = data.nama || '';
        document.getElementById('kt_jabatan').value = data.jabatan_peran || '';
        document.getElementById('kt_telp').value = data.no_telp || '';
        document.getElementById('kt_alamat').value = data.alamat || '';
    } else {
        title.innerText = 'Tambah Kontak Penting Baru';
        form.action = "{{ route('admin.kontak.store') }}";
        methodInput.value = 'POST';
        form.reset();
    }

    document.getElementById('modal-kontak').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeKontakModal() {
    document.getElementById('modal-kontak').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>
@endsection

