@extends('layouts.admin')

@section('title', 'Kelola Jenis Surat')

@section('content')

<!-- Header Action -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-lg font-extrabold text-slate-800 tracking-tight">Katalog Jenis Surat</h2>
        <p class="text-xs text-slate-400 mt-0.5">Pengaturan opsi surat yang dapat diajukan warga.</p>
    </div>
    <button onclick="openJenisSuratModal('create')" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
        <i class="ti ti-plus text-base"></i>
        <span>Tambah Jenis Surat</span>
    </button>
</div>

<!-- Table Card -->
<div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/30 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50/80 text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4">Kode Surat</th>
                    <th class="px-6 py-4">Nama Jenis Surat</th>
                    <th class="px-6 py-4">Status Layanan</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                @forelse ($jenisSurats as $j)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 font-mono font-bold text-emerald-800">{{ $j->kode }}</td>
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $j->nama_surat }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $j->aktif ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                            {{ $j->aktif ? 'Aktif Layanan' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right whitespace-nowrap space-x-2">
                        <button onclick='openJenisSuratModal("edit", @json($j))' class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </button>
                        <form action="{{ route('admin.jenissurat.destroy', ['jenissurat' => $j->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus jenis surat ini?')">
                            @csrf @method('DELETE')
                            <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-red-50 text-slate-600 hover:text-red-600 font-bold text-[11px] transition-colors">
                                <i class="ti ti-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400">Belum ada jenis surat terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">{{ $jenisSurats->links() }}</div>

<!-- Modal Form Jenis Surat -->
<div id="modal-jenissurat" class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden animate-fadeIn">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-2xl max-w-lg w-full p-6 md:p-8 space-y-6 relative" onclick="event.stopPropagation()">
        <button onclick="closeJenisSuratModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <div class="border-b border-slate-100 pb-4">
            <h3 id="modal-jenissurat-title" class="text-lg font-extrabold text-slate-800">Form Jenis Surat</h3>
            <p class="text-xs text-slate-400 mt-0.5">Pengaturan informasi dan syarat layanan surat.</p>
        </div>

        <form id="form-jenissurat" method="POST" action="{{ route('admin.jenissurat.store') }}" class="space-y-4 text-xs">
            @csrf
            <input type="hidden" id="jenissurat-method" name="_method" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Kode Surat <span class="text-red-500">*</span></label>
                    <input type="text" id="js_kode" name="kode" required placeholder="Contoh: SKD / SKU"
                           class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-mono font-bold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 uppercase mb-1">Status Layanan</label>
                    <select id="js_aktif" name="aktif" class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-bold">
                        <option value="1">Aktif Layanan</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Nama Jenis Surat <span class="text-red-500">*</span></label>
                <input type="text" id="js_nama" name="nama_surat" required placeholder="Contoh: Surat Keterangan Usaha"
                       class="w-full border border-slate-200 rounded-2xl px-4 py-2.5 font-semibold focus:ring-2 focus:ring-emerald-500 focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Deskripsi Layanan</label>
                <textarea id="js_deskripsi" name="deskripsi" rows="2" placeholder="Penjelasan kegunaan surat..."
                          class="w-full border border-slate-200 rounded-2xl p-3 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block font-bold text-slate-700 uppercase mb-1">Persyaratan Berkas (Per baris)</label>
                <textarea id="js_persyaratan" name="persyaratan" rows="3" placeholder="Fotokopi KTP&#10;Fotokopi KK..."
                          class="w-full border border-slate-200 rounded-2xl p-3 font-medium focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeJenisSuratModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-5 py-2.5 rounded-2xl transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-2.5 rounded-2xl shadow-lg shadow-emerald-700/20 hover:scale-[1.02] transition-all">
                    Simpan Layanan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openJenisSuratModal(mode, data = null) {
    const form = document.getElementById('form-jenissurat');
    const methodInput = document.getElementById('jenissurat-method');
    const title = document.getElementById('modal-jenissurat-title');

    if (mode === 'edit' && data) {
        title.innerText = 'Edit Jenis Surat: ' + data.nama_surat;
        form.action = "{{ route('admin.jenissurat.update', ['jenissurat' => ':id']) }}".replace(':id', data.id);
        methodInput.value = 'PUT';

        document.getElementById('js_kode').value = data.kode || '';
        document.getElementById('js_nama').value = data.nama_surat || '';
        document.getElementById('js_aktif').value = data.aktif ? "1" : "0";
        document.getElementById('js_deskripsi').value = data.deskripsi || '';
        document.getElementById('js_persyaratan').value = data.persyaratan || '';
    } else {
        title.innerText = 'Tambah Jenis Surat Baru';
        form.action = "{{ route('admin.jenissurat.store') }}";
        methodInput.value = 'POST';
        form.reset();
    }

    document.getElementById('modal-jenissurat').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeJenisSuratModal() {
    document.getElementById('modal-jenissurat').classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>

@endsection


