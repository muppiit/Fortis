<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Attendance</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --background: #f9fafb;
            --card: #ffffff;
            --border: #e5e7eb;
            --text: #1f2937;
            --text-secondary: #6b7280;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text);
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
        }

        .card {
            background-color: var(--card);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .search-container {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-input {
            width: 100%;
            padding: 8px 8px 8px 36px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: var(--primary);
        }

        .filter-container {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            background-color: white;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: var(--primary);
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            background-color: #f3f4f6;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        th:hover {
            background-color: #e5e7eb;
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover {
            background-color: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-in {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .badge-out {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .badge-break {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .button-primary {
            background-color: var(--primary);
            color: white;
        }

        .button-primary:hover {
            background-color: var(--primary-hover);
        }

        .button-outline {
            background-color: transparent;
            border: 1px solid var(--border);
            color: var(--text);
        }

        .button-outline:hover {
            background-color: #f3f4f6;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-top: 1px solid var(--border);
        }

        .pagination-info {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
        }

        .pagination-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 6px;
            border: 1px solid var(--border);
            background-color: white;
            cursor: pointer;
            transition: all 0.2s;
        }

        .pagination-button:hover {
            background-color: #f3f4f6;
        }

        .pagination-button.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-state {
            padding: 48px 0;
            text-align: center;
            color: var(--text-secondary);
        }

        .empty-state-icon {
            margin-bottom: 16px;
            color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-container {
                max-width: 100%;
            }

            th,
            td {
                padding: 10px 12px;
            }
        }
    </style>
</head>

<body>
    <div class="card-header">
        @if (auth()->user()->role->level === 'super_super_admin')
            <div class="card mb-4 p-3 border rounded">
                <h5>Atur Jam Masuk & Jam Pulang Perusahaan</h5>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.attendance.update-working-hours') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group mr-3">
                        <label for="clock_in_time">Jam Masuk</label>
                        <input type="time" id="clock_in_time" name="clock_in_time" class="form-control ml-2"
                            value="{{ old('clock_in_time', $workingHour->clock_in_time ?? '') }}" required>
                    </div>
                    <div class="form-group mr-3">
                        <label for="clock_out_time">Jam Pulang</label>
                        <input type="time" id="clock_out_time" name="clock_out_time" class="form-control ml-2"
                            value="{{ old('clock_out_time', $workingHour->clock_out_time ?? '') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        @endif

        <div class="search-container">
            <div class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <input type="text" class="search-input" placeholder="Cari berdasarkan nama atau NIP..." id="searchInput"
                oninput="filterTable()">
        </div>
        <div class="filter-container">
            <select class="filter-select" id="typeFilter" onchange="filterTable()">
                <option value="">Semua Tipe</option>
                <option value="clock-in">clock-in</option>
                <option value="clock-out">clock-out</option>
            </select>
        </div>
    </div>

    <div class="table-container">
        <table id="attendanceTable">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">NIP</th>
                    <th onclick="sortTable(1)">Nama</th>
                    <th onclick="sortTable(2)">Departemen</th>
                    <th onclick="sortTable(3)">Team Departemen</th>
                    <th onclick="sortTable(4)">Manajer Departemen</th>
                    <th onclick="sortTable(5)">Tipe</th>
                    <th onclick="sortTable(6)">Waktu</th>
                    <th onclick="sortTable(7)">Telat</th>
                    <th onclick="sortTable(8)">Lembur</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $a)
                    <tr>
                        <td>{{ $a->user->nip }}</td>
                        <td>{{ $a->user->name }}</td>
                        <td>{{ $a->user->teamDepartment->department->department ?? '-' }}</td>
                        <td>{{ $a->user->teamDepartment->name ?? '-' }}</td>
                        <td>{{ $a->user->teamDepartment->department->manager_department ?? '-' }}</td>
                        <td>
                            @if ($a->type == 'clock-in')
                                <span class="badge badge-in">clock-in</span>
                            @elseif($a->type == 'clock-out')
                                <span class="badge badge-out">clock-out</span>
                            @else
                                <span class="badge badge-break">{{ $a->type }}</span>
                            @endif
                        </td>
                        <td>{{ $a->waktu->format('d M Y, H:i') }}</td>
                        <td>
                            @if ($a->late_duration !== null)
                                {{ rtrim(rtrim(number_format($a->late_duration, 2), '0'), '.') }} jam
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($a->overtime_duration !== null)
                                {{ rtrim(rtrim(number_format($a->overtime_duration, 2), '0'), '.') }} jam
                            @else
                                -
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="pagination">
        <div class="pagination-info">
            Menampilkan <span id="startRecord">1</span> sampai <span id="endRecord">10</span> dari <span
                id="totalRecords">0</span> data
        </div>
        <div class="pagination-controls">
            <button class="pagination-button" id="prevPage" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="pagination-button active">1</button>
            <button class="pagination-button">2</button>
            <button class="pagination-button">3</button>
            <button class="pagination-button" id="nextPage">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>
    </div>

    <a href="{{ route('admin.dashboard') }}">
        <button type="button" class="button button-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Dashboard
        </button>
    </a>
    </div>

    <script>
        // Populate department filter dynamically
        document.addEventListener('DOMContentLoaded', function() {
            const departmentFilter = document.getElementById('departmentFilter');
            const departments = new Set();

            // Get all department values from the table
            const departmentCells = document.querySelectorAll('tbody tr td:nth-child(3)');
            departmentCells.forEach(cell => {
                if (cell.textContent.trim() !== '-') {
                    departments.add(cell.textContent.trim());
                }
            });

            // Add options to the select element
            departments.forEach(department => {
                const option = document.createElement('option');
                option.value = department;
                option.textContent = department;
                departmentFilter.appendChild(option);
            });

            // Update total records count
            updatePaginationInfo();
        });

        // Filter table based on search input and filters
        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const departmentFilter = document.getElementById('departmentFilter').value;
            const typeFilter = document.getElementById('typeFilter').value;
            const rows = document.querySelectorAll('tbody tr');

            let visibleCount = 0;

            rows.forEach(row => {
                const nip = row.cells[0].textContent.toLowerCase();
                const name = row.cells[1].textContent.toLowerCase();
                const department = row.cells[2].textContent.trim();
                const typeCell = row.cells[5].querySelector('.badge');
                const type = typeCell ? typeCell.textContent.toLowerCase() : '';

                const matchesSearch = nip.includes(searchInput) || name.includes(searchInput);
                const matchesDepartment = departmentFilter === '' || department === departmentFilter;
                const matchesType = typeFilter === '' || type.toLowerCase().includes(typeFilter.toLowerCase());

                if (matchesSearch && matchesDepartment && matchesType) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show empty state if no results
            if (visibleCount === 0) {
                const tbody = document.querySelector('tbody');
                if (!document.getElementById('emptyState')) {
                    const emptyRow = document.createElement('tr');
                    emptyRow.id = 'emptyState';
                    emptyRow.innerHTML = `
                        <td colspan="7" class="empty-state">
                            <div class="empty-state-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                            <h3>Tidak ada data yang ditemukan</h3>
                            <p>Coba ubah filter atau kata kunci pencarian</p>
                        </td>
                    `;
                    tbody.appendChild(emptyRow);
                }
            } else {
                const emptyState = document.getElementById('emptyState');
                if (emptyState) {
                    emptyState.remove();
                }
            }

            updatePaginationInfo();
        }

        // Sort table by column
        function sortTable(columnIndex) {
            const table = document.querySelector('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            // Get current sort direction
            const th = table.querySelectorAll('th')[columnIndex];
            const currentDirection = th.getAttribute('data-sort') === 'asc' ? 'desc' : 'asc';

            // Reset all headers
            table.querySelectorAll('th').forEach(header => {
                header.removeAttribute('data-sort');
            });

            // Set new sort direction
            th.setAttribute('data-sort', currentDirection);

            // Sort rows
            rows.sort((a, b) => {
                let aValue = a.cells[columnIndex].textContent.trim();
                let bValue = b.cells[columnIndex].textContent.trim();

                // Handle date sorting for the time column
                if (columnIndex === 6) {
                    aValue = new Date(aValue);
                    bValue = new Date(bValue);
                }

                // Compare values
                if (aValue < bValue) {
                    return currentDirection === 'asc' ? -1 : 1;
                }
                if (aValue > bValue) {
                    return currentDirection === 'asc' ? 1 : -1;
                }
                return 0;
            });

            // Reorder rows in the table
            rows.forEach(row => {
                tbody.appendChild(row);
            });
        }

        // Update pagination information
        function updatePaginationInfo() {
            const visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])').length;
            document.getElementById('totalRecords').textContent = visibleRows;

            // For simplicity, we're just updating the total count
            // In a real implementation, you would calculate start and end based on current page
            const startRecord = visibleRows > 0 ? 1 : 0;
            const endRecord = Math.min(10, visibleRows);

            document.getElementById('startRecord').textContent = startRecord;
            document.getElementById('endRecord').textContent = endRecord;
        }
    </script>
</body>

</html>
