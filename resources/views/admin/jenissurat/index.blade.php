@extends('layouts.admin')

@section('title', 'Kelola Jenis Surat')

@section('content')

<!-- Header Action -->
<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-lg font-extrabold text-slate-800 tracking-tight">Katalog Jenis Surat</h2>
        <p class="text-xs text-slate-400 mt-0.5">Pengaturan opsi surat yang dapat diajukan warga.</p>
    </div>
    <a href="{{ route('admin.jenissurat.create') }}" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold px-6 py-3 rounded-2xl text-xs shadow-lg shadow-emerald-700/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center gap-2">
        <i class="ti ti-plus text-base"></i>
        <span>Tambah Jenis Surat</span>
    </a>
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
                        <a href="{{ route('admin.jenissurat.edit', $j) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 font-bold text-[11px] transition-colors">
                            <i class="ti ti-edit"></i> Ubah
                        </a>
                        <form action="{{ route('admin.jenissurat.destroy', $j) }}" method="POST" class="inline" onsubmit="return confirm('Hapus jenis surat ini?')">
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

@endsection

