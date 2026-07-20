@extends('layouts.admin')

@section('title', $penduduk->exists ? 'Ubah Penduduk' : 'Tambah Penduduk')

@section('content')

<form method="POST"
      action="{{ $penduduk->exists ? route('admin.penduduk.update', $penduduk) : route('admin.penduduk.store') }}"
      enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow p-6 md:p-8 max-w-3xl space-y-5">
    @csrf
    @if ($penduduk->exists) @method('PUT') @endif

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block font-semibold mb-1 text-sm">NIK *</label>
            <input type="text" name="nik" maxlength="16" value="{{ old('nik', $penduduk->nik) }}" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-1 text-sm">No. KK</label>
            <input type="text" name="no_kk" maxlength="16" value="{{ old('no_kk', $penduduk->no_kk) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Nama Lengkap *</label>
        <input type="text" name="nama" value="{{ old('nama', $penduduk->nama) }}" required
               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="block font-semibold mb-1 text-sm">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-1 text-sm">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($penduduk->tanggal_lahir)->format('Y-m-d')) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-5">
        <div>
            <label class="block font-semibold mb-1 text-sm">Jenis Kelamin *</label>
            <select name="jenis_kelamin" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
                <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1 text-sm">RT</label>
            <input type="text" name="rt" maxlength="3" value="{{ old('rt', $penduduk->rt) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-1 text-sm">RW</label>
            <input type="text" name="rw" maxlength="3" value="{{ old('rw', $penduduk->rw) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Alamat</label>
        <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">{{ old('alamat', $penduduk->alamat) }}</textarea>
    </div>

    <div class="grid md:grid-cols-3 gap-5">
        <div>
            <label class="block font-semibold mb-1 text-sm">Agama</label>
            <input type="text" name="agama" value="{{ old('agama', $penduduk->agama) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-1 text-sm">Status Perkawinan</label>
            <input type="text" name="status_perkawinan" value="{{ old('status_perkawinan', $penduduk->status_perkawinan) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-1 text-sm">Pekerjaan</label>
            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Pendidikan Terakhir</label>
        <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $penduduk->pendidikan_terakhir) }}"
               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-emerald-600 focus:outline-none">
    </div>

    <div>
        <label class="block font-semibold mb-1 text-sm">Foto</label>
        <input type="file" name="foto" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2.5">
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="bg-emerald-700 text-white font-bold px-6 py-2.5 rounded-lg hover:bg-emerald-800">Simpan</button>
        <a href="{{ route('admin.penduduk.index') }}" class="bg-gray-200 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-300">Batal</a>
    </div>
</form>

@endsection
