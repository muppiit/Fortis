<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Attendance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --danger: #e63946;
            --warning: #ffb703;
            --info: #8ecae6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: #333;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            color: #333;
            display: flex;
            align-items: center;
        }

        .page-title i {
            margin-right: 15px;
            font-size: 32px;
            color: var(--primary);
            background-color: rgba(67, 97, 238, 0.1);
            padding: 10px;
            border-radius: 10px;
        }

        .back-button {
            background-color: white;
            border: none;
            color: #555;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.2);
        }

        .back-button i {
            margin-right: 8px;
        }

        .attendance-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            overflow: hidden;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 20px;
            color: white;
        }

        .card-header h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .card-header p {
            font-size: 14px;
            opacity: 0.8;
        }

        .card-body {
            padding: 25px;
        }

        /* Tools Section */
        .attendance-tools {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: #f5f7fb;
            border-radius: 8px;
            padding: 0 15px;
            flex: 1;
            max-width: 400px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .search-box input {
            border: none;
            background: transparent;
            padding: 12px 10px;
            font-size: 14px;
            width: 100%;
            outline: none;
        }

        .search-box i {
            color: #777;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-select {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            color: #555;
            background-color: white;
            cursor: pointer;
            outline: none;
            min-width: 150px;
            transition: all 0.3s ease;
        }

        .filter-select:focus, .filter-select:hover {
            border-color: var(--primary);
            box-shadow: 0 2px 5px rgba(67, 97, 238, 0.1);
        }

        .export-btn {
            background-color: #f1f3f9;
            color: #555;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            background-color: #e2e6f1;
        }

        /* Table Styles */
        .attendance-table-wrapper {
            overflow-x: auto;
            border-radius: 8px;
        }

        .attendance-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .attendance-table th, .attendance-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .attendance-table th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            position: sticky;
            top: 0;
        }

        .attendance-table th:first-child {
            border-top-left-radius: 8px;
        }

        .attendance-table th:last-child {
            border-top-right-radius: 8px;
        }

        .attendance-table tbody tr {
            transition: all 0.3s ease;
        }

        .attendance-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .attendance-table tbody tr:last-child td {
            border-bottom: none;
        }

        .attendance-table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 8px;
        }

        .attendance-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 8px;
        }

        .attendance-table tbody td {
            font-size: 14px;
        }

        /* User Name Column */
        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #e2e6f1;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-right: 10px;
            font-weight: 600;
        }

        /* Time Column */
        .time-info {
            display: flex;
            flex-direction: column;
        }

        .time-value {
            font-weight: 500;
        }

        .time-date {
            font-size: 12px;
            color: #777;
            margin-top: 3px;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-info {
            font-size: 14px;
            color: #666;
        }

        .pagination {
            display: flex;
            list-style: none;
            gap: 5px;
        }

        .pagination li a {
            display: flex;
            width: 35px;
            height: 35px;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            text-decoration: none;
            color: #555;
            font-size: 14px;
            background-color: white;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .pagination li a:hover, .pagination li a.active {
            background-color: var(--primary);
            color: white;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .summary-card-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .summary-card-value {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .summary-card-sub {
            font-size: 12px;
            color: #888;
            display: flex;
            align-items: center;
        }

        .summary-card-sub i {
            margin-right: 5px;
        }

        .summary-card-sub.up {
            color: #2ecc71;
        }

        .summary-card-sub.down {
            color: #e74c3c;
        }

        /* Empty State */
        .empty-state {
            padding: 40px;
            text-align: center;
            display: none;
        }

        .empty-state-icon {
            font-size: 50px;
            color: #ddd;
            margin-bottom: 15px;
        }

        .empty-state-text {
            font-size: 16px;
            color: #888;
            margin-bottom: 20px;
        }

        /* Loading Animation */
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }

        .loading .spinner {
            border: 3px solid rgba(0, 0, 0, 0.1);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .back-button {
                align-self: flex-start;
            }
            
            .attendance-tools {
                flex-direction: column;
            }
            
            .search-box {
                max-width: 100%;
            }
            
            .filter-group {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 10px;
            }
            
            .summary-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="page-title">
            <i class="fas fa-calendar-check"></i>
            Daftar Kehadiran User
        </h1>
        
        <a href="{{ route('admin.dashboard') }}">
            <button class="back-button">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </button>
        </a>
    </div>
    
    <!-- Summary Cards -->
    <div class="summary-cards">
        <div class="summary-card">
            <div class="summary-card-title">Total Kehadiran</div>
            <div class="summary-card-value" id="totalAttendance">{{ count($attendances) }}</div>
        </div>
        
        <div class="summary-card">
            <div class="summary-card-title">Check In Hari Ini</div>
            <div class="summary-card-value" id="todayCheckIn"></div>
        </div>
        
        <div class="summary-card">
            <div class="summary-card-title">Check Out Hari Ini</div>
            <div class="summary-card-value" id="todayCheckOut"></div>
        </div>
        
        <div class="summary-card">
            <div class="summary-card-title">Departemen Aktif</div>  
            <div class="summary-card-value" id="activeDepartments"></div>
        </div>
    </div>
    
    <div class="attendance-card">
        <div class="card-header">
            <h2>Data Kehadiran</h2>
            <p>Daftar lengkap aktivitas kehadiran karyawan</p>
        </div>
        
        <div class="card-body">
            <!-- Tools Section -->
            <div class="attendance-tools">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, NIP, departemen...">
                </div>
                
                <div class="filter-group">
                    <select class="filter-select" id="filterDepartment">
                        <option value="">Semua Departemen</option>
                        <!-- Will be populated by JS -->
                    </select>
                </div>
            </div>
            
            <!-- Table Section -->
            <div class="attendance-table-wrapper">
                <table class="attendance-table" id="attendanceTable">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Departemen</th>
                            <th>Team</th>
                            <th>Manager</th>
                            <th>Tipe</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $a)
                            <tr data-department="{{ $a->user->departement ?? '' }}" data-type="{{ $a->type }}">
                                <td>{{ $a->nip }}</td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ $a->user ? substr($a->user->nama, 0, 1) : '-' }}
                                        </div>
                                        {{ $a->user->nama ?? '-' }}
                                    </div>
                                </td>
                                <td>{{ $a->user->departement ?? '-' }}</td>
                                <td>{{ $a->user->team_departement ?? '-' }}</td>
                                <td>{{ $a->user->manager_departement ?? '-' }}</td>
                                <td>{{ $a->type ?? '-' }}</td>
                                <td>
                                    <div class="time-info">
                                        <span class="time-value">
                                            {{ \Carbon\Carbon::parse($a->waktu)->format('H:i') }}
                                        </span>
                                        <span class="time-date">
                                            {{ \Carbon\Carbon::parse($a->waktu)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Empty State - Will be shown when no results found -->
                <div class="empty-state" id="emptyState">
                    <div class="empty-state-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="empty-state-text">Tidak ada data kehadiran yang sesuai dengan filter</div>
                </div>
                
                <!-- Loading Animation -->
                <div class="loading" id="loadingState">
                    <div class="spinner"></div>
                    <p>Memuat data...</p>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="pagination-container">
                <div class="page-info">Menampilkan <span id="currentShowing">{{ count($attendances) }}</span> dari <span id="totalItems">{{ count($attendances) }}</span> data</div>
                
                <ul class="pagination">
                    <li><a href="#" id="prevPage"><i class="fas fa-chevron-left"></i></a></li>
                    <li><a href="#" class="active">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#" id="nextPage"><i class="fas fa-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search Functionality
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('attendanceTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            const emptyState = document.getElementById('emptyState');
            const loadingState = document.getElementById('loadingState');
            const currentShowing = document.getElementById('currentShowing');
            
            // Populate departments filter dynamically
            const filterDepartment = document.getElementById('filterDepartment');
            const departments = new Set();
            
            for (let i = 0; i < rows.length; i++) {
                const dept = rows[i].getAttribute('data-department');
                if (dept && dept !== '-') {
                    departments.add(dept);
                }
            }
            
            departments.forEach(dept => {
                const option = document.createElement('option');
                option.value = dept;
                option.textContent = dept;
                filterDepartment.appendChild(option);
            });
            
            // Update summary cards
            const totalAttendance = document.getElementById('totalAttendance');
            const todayCheckIn = document.getElementById('todayCheckIn');
            const todayCheckOut = document.getElementById('todayCheckOut');
            const activeDepartments = document.getElementById('activeDepartments');
            
            // Set active departments
            activeDepartments.textContent = departments.size;
            
            // Count today's check-ins and check-outs
            let checkIns = 0;
            let checkOuts = 0;
            
            const today = new Date().toISOString().split('T')[0];
            
            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                const timeCell = cells[6].querySelector('.time-date');
                const timeText = timeCell.textContent.trim();
                
                // Convert date format to check if it's today
                const dateParts = timeText.split(' ');
                const month = getMonthNumber(dateParts[1]);
                const formattedDate = `${dateParts[2]}-${month}-${dateParts[0].padStart(2, '0')}`;
                
                const type = rows[i].getAttribute('data-type');
                
                if (formattedDate === today) {
                    if (type === 'in') {
                        checkIns++;
                    } else if (type === 'out') {
                        checkOuts++;
                    }
                }
            }
            
            todayCheckIn.textContent = checkIns;
            todayCheckOut.textContent = checkOuts;
            
            // Helper function to convert month name to number
            function getMonthNumber(monthName) {
                const months = {
                    'Jan': '01', 'Feb': '02', 'Mar': '03', 'Apr': '04',
                    'May': '05', 'Jun': '06', 'Jul': '07', 'Aug': '08',
                    'Sep': '09', 'Oct': '10', 'Nov': '11', 'Dec': '12'
                };
                return months[monthName] || '01';
            }
            
            // Combined filter and search function
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const departmentFilter = filterDepartment.value.toLowerCase();
                
                // Show loading state briefly
                loadingState.style.display = 'block';
                
                setTimeout(() => {
                    let visibleCount = 0;
                    
                    for (let i = 0; i < rows.length; i++) {
                        const cells = rows[i].getElementsByTagName('td');
                        const rowDepartment = rows[i].getAttribute('data-department').toLowerCase();
                        
                        // Department filtering
                        const departmentMatch = departmentFilter === '' || rowDepartment.includes(departmentFilter);
                        
                        // Text search across all columns
                        let textMatch = false;
                        for (let j = 0; j < cells.length; j++) {
                            const cellText = cells[j].textContent.toLowerCase();
                            if (cellText.indexOf(searchTerm) > -1) {
                                textMatch = true;
                                break;
                            }
                        }
                        
                        if (textMatch && departmentMatch) {
                            rows[i].style.display = '';
                            visibleCount++;
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                    
                    // Update counter and show empty state if needed
                    currentShowing.textContent = visibleCount;
                    
                    if (visibleCount === 0) {
                        emptyState.style.display = 'block';
                    } else {
                        emptyState.style.display = 'none';
                    }
                    
                    loadingState.style.display = 'none';
                }, 300); // Brief delay to show loading animation
            }
            
            // Event listeners for all filters
            searchInput.addEventListener('keyup', filterTable);
            filterDepartment.addEventListener('change', filterTable);
            
            // Pagination
            const prevPage = document.getElementById('prevPage');
            const nextPage = document.getElementById('nextPage');
            
            // Apply a subtle animation to rows when they appear
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.opacity = '0';
                rows[i].style.transform = 'translateY(10px)';
                rows[i].style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                
                setTimeout(() => {
                    rows[i].style.opacity = '1';
                    rows[i].style.transform = 'translateY(0)';
                }, 50 * i);
            }
        });
    </script>
</body>
</html>