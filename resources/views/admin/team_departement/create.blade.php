@php
    $user = auth()->user();
@endphp

<!-- Tambahkan Tailwind CSS jika belum -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-blue-200">
    <h2 class="text-2xl font-semibold text-blue-600 mb-6 text-center">Tambah Team Department</h2>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.team_departments.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Pilih Department --}}
        <div>
            <label for="department_id" class="block text-sm font-medium text-blue-700">Pilih Departemen</label>
            <select name="department_id" id="department_id" required
                class="mt-1 w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                {{ $user->role->level === 'super_admin' ? 'disabled' : '' }}>
                <option value="">-- Pilih Department --</option>
                @foreach ($departments as $department)
                    @if ($user->role->level === 'super_super_admin' || 
                        ($user->role->level === 'super_admin' && $department->id === $user->teamDepartment->department_id))
                        <option value="{{ $department->id }}"
                            {{ old('department_id', $user->teamDepartment->department_id ?? '') == $department->id ? 'selected' : '' }}>
                            {{ $department->department }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('department_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nama Team --}}
        <div>
            <label for="name" class="block text-sm font-medium text-blue-700">Nama Team Department</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                class="mt-1 w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center mt-6">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md">
                Simpan
            </button>
            <a href="{{ route('admin.team_departments.index') }}"
                class="text-blue-600 hover:text-blue-800 transition duration-300 underline">
                Kembali
            </a>
        </div>
    </form>
</div>
