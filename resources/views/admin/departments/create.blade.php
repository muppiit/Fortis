<!-- Tambahkan Tailwind CSS jika belum -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8 border border-blue-200">
    <h2 class="text-2xl font-semibold text-blue-600 mb-6 text-center">Tambah Departemen Baru</h2>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="department" class="block text-sm font-medium text-blue-700">Nama Departemen</label>
            <input type="text" id="department" name="department" required
                class="mt-1 w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <div>
            <label for="manager_department" class="block text-sm font-medium text-blue-700">Manager Departemen</label>
            <input type="text" id="manager_department" name="manager_department" required
                class="mt-1 w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
        </div>

        <div class="flex justify-between items-center mt-6">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300 shadow-md">Simpan</button>
            <a href="{{ route('admin.departments.index') }}"
                class="text-blue-600 hover:text-blue-800 transition duration-300 underline">Kembali</a>
        </div>
    </form>
</div>
