<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Cuti</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --info: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #adb5bd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7ff;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 {
            color: var(--primary);
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .header h2 i {
            margin-right: 10px;
            color: var(--primary);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            animation: fadeIn 0.5s;
        }

        .alert-success {
            background-color: rgba(76, 201, 240, 0.2);
            border-left: 4px solid var(--success);
            color: #087990;
        }

        .alert i {
            margin-right: 10px;
            font-size: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--gray);
        }

        .stat-icon {
            font-size: 40px;
            opacity: 0.8;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .stat-pending {
            color: var(--warning);
            background-color: rgba(248, 150, 30, 0.1);
        }

        .stat-approved {
            color: var(--success);
            background-color: rgba(76, 201, 240, 0.1);
        }

        .stat-rejected {
            color: var(--danger);
            background-color: rgba(247, 37, 133, 0.1);
        }

        .stat-total {
            color: var(--primary);
            background-color: rgba(67, 97, 238, 0.1);
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            align-items: center;
        }

        .filter-group label {
            margin-right: 10px;
            font-weight: 500;
            color: var(--dark);
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
            color: var(--dark);
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .filter-select:focus {
            border-color: var(--primary);
            outline: none;
        }

        table.dataTable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        table.dataTable thead th {
            background-color: var(--primary);
            color: white;
            padding: 12px;
            font-weight: 500;
            text-align: left;
            border: none;
        }

        table.dataTable tbody td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        table.dataTable tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        table.dataTable tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
            text-transform: uppercase;
        }

        .status-cuti {
            background-color: rgba(72, 149, 239, 0.2);
            color: var(--info);
        }

        .status-sakit {
            background-color: rgba(247, 37, 133, 0.2);
            color: var(--danger);
        }

        .approval-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            display: inline-block;
            text-transform: uppercase;
        }

        .approval-pending {
            background-color: rgba(248, 150, 30, 0.2);
            color: var(--warning);
        }

        .approval-approved {
            background-color: rgba(76, 201, 240, 0.2);
            color: var(--success);
        }

        .approval-rejected {
            background-color: rgba(247, 37, 133, 0.2);
            color: var(--danger);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 14px;
            text-decoration: none;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 4px;
            margin-right: 5px;
            font-size: 13px;
        }

        .detail-btn {
            background-color: var(--info);
            color: white;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            border-radius: 4px;
            padding: 6px 12px;
            transition: all 0.3s ease;
        }

        .detail-btn:hover {
            background-color: #3a7fc8;
            transform: translateY(-2px);
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .pagination a {
            color: var(--dark);
            padding: 8px 12px;
            text-decoration: none;
            background-color: white;
            border: 1px solid #ddd;
            margin: 0 4px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .pagination a.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination a:hover:not(.active) {
            background-color: #f1f1f1;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px 0;
            color: var(--gray);
            font-size: 14px;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 15px;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                text-align: center;
            }

            .header .btn {
                margin-top: 15px;
            }

            .filters {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }

            .filter-select {
                width: 100%;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2> Daftar Pengajuan Cuti</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="alert alert-success fade-in">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <div>
                    <div class="stat-value">24</div>
                    <div class="stat-label">Total Pengajuan</div>
                </div>
                <div class="stat-icon stat-total">
                    <i class="fas fa-clipboard-list"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <div class="stat-value">8</div>
                    <div class="stat-label">Menunggu Persetujuan</div>
                </div>
                <div class="stat-icon stat-pending">
                    <i class="fas fa-clock"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Disetujui</div>
                </div>
                <div class="stat-icon stat-approved">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>

            <div class="stat-card">
                <div>
                    <div class="stat-value">4</div>
                    <div class="stat-label">Ditolak</div>
                </div>
                <div class="stat-icon stat-rejected">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card">
            <div class="filters">
                <div class="filter-group">
                    <label for="filter-department">Departemen:</label>
                    <select id="filter-department" class="filter-select">
                        <option value="">Semua Departemen</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="filter-team">Tim:</label>
                    <select id="filter-team" class="filter-select">
                        <option value="">Semua Tim</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filter-status">Status:</label>
                    <select id="filter-status" class="filter-select">
                        <option value="">Semua Status</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filter-approval">Persetujuan:</label>
                    <select id="filter-approval" class="filter-select">
                        <option value="">Semua</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card">
            <table id="leaves-table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>Tim</th>
                        <th>Manager</th>
                        <th>Tipe Cuti</th>
                        <th>Status</th>
                        <th>Disetujui Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $l)
                        <tr>
                            <td>{{ $l->user->nip }}</td>
                            <td>{{ $l->user->name ?? '-' }}</td>
                            <td>{{ $l->user->teamDepartment->department->department ?? '-' }}</td>
                            <td>{{ $l->user->teamDepartment->name ?? '-' }}</td>
                            <td>{{ $l->user->teamDepartment->department->manager_department ?? '-' }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower($l->type) }}">
                                    {{ ucfirst($l->type) }}
                                </span>
                            </td>
                            <td>
                                <span class="approval-badge approval-{{ strtolower($l->status) }}">
                                    {{ ucfirst($l->status) }}
                                </span>
                            </td>
                            <td>
                                {{ $l->approver->name ?? '-' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.leaves.show', $l->id) }}" class="detail-btn">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#leaves-table').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                    zeroRecords: "Tidak ada data yang cocok",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                responsive: true,
                columnDefs: [{
                    responsivePriority: 1,
                    targets: [1, 5, 6, 7]
                }]
            });

            // Populate filter options dynamically from table data
            function populateFilterOptions() {
                // Get all unique departments
                const departments = [];
                table.column(2).data().unique().sort().each(function(value) {
                    if (value && value !== '-' && departments.indexOf(value) === -1) {
                        departments.push(value);
                    }
                });

                // Add departments to filter dropdown
                departments.forEach(function(department) {
                    $('#filter-department').append(`<option value="${department}">${department}</option>`);
                });

                // Get all unique teams
                const teams = [];
                table.column(3).data().unique().sort().each(function(value) {
                    if (value && value !== '-' && teams.indexOf(value) === -1) {
                        teams.push(value);
                    }
                });

                // Add teams to filter dropdown
                teams.forEach(function(team) {
                    $('#filter-team').append(`<option value="${team}">${team}</option>`);
                });

                // Get all unique status types
                const statuses = [];
                table.column(5).nodes().to$().find('.status-badge').each(function() {
                    const statusText = $(this).text().trim().toLowerCase();
                    if (statusText && statuses.indexOf(statusText) === -1) {
                        statuses.push(statusText);
                    }
                });

                // Add statuses to filter dropdown
                statuses.forEach(function(status) {
                    $('#filter-status').append(
                        `<option value="${status}">${status.charAt(0).toUpperCase() + status.slice(1)}</option>`
                        );
                });

                // Get all unique approval statuses
                const approvals = [];
                table.column(6).nodes().to$().find('.approval-badge').each(function() {
                    const approvalText = $(this).text().trim().toLowerCase();
                    if (approvalText && approvals.indexOf(approvalText) === -1) {
                        approvals.push(approvalText);
                    }
                });

                // Add approvals to filter dropdown
                approvals.forEach(function(approval) {
                    const label = approval === 'pending' ? 'Menunggu' :
                        approval === 'approved' ? 'Disetujui' :
                        approval === 'rejected' ? 'Ditolak' : approval;
                    $('#filter-approval').append(`<option value="${approval}">${label}</option>`);
                });
            }

            // Call the function to populate filter options
            populateFilterOptions();

            // Apply filters
            $('#filter-department, #filter-team, #filter-status, #filter-approval').on('change', function() {
                // const department = $('#filter-department').val();
                // const team = $('#filter-team').val();
                const status = $('#filter-status').val();
                const approval = $('#filter-approval').val();

                // Custom filtering function
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    // const rowDepartment = data[2]; // Departemen column
                    // const rowTeam = data[3]; // Tim column
                    const rowStatus = data[5].toLowerCase(); // Status column (extract from badge)
                    const rowApproval = data[6]
                .toLowerCase(); // Approval column (extract from badge)

                    // // Check department filter
                    // if (department && rowDepartment.indexOf(department) === -1) {
                    //     return false;
                    // }

                    // // Check team filter
                    // if (team && rowTeam.indexOf(team) === -1) {
                    //     return false;
                    // }

                    // Check status filter
                    if (status && !rowStatus.includes(status.toLowerCase())) {
                        return false;
                    }

                    // Check approval filter
                    if (approval && !rowApproval.includes(approval.toLowerCase())) {
                        return false;
                    }

                    return true;
                });

                // Redraw table with filters applied
                table.draw();

                // Remove custom filter function after drawing
                $.fn.dataTable.ext.search.pop();
            });

            // Auto-hide alert after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Dynamically calculate dashboard stats based on actual data
            function updateDashboardStats() {
                const totalRows = table.rows().nodes().length;

                const pendingRows = $(table.rows().nodes()).filter(function() {
                    return $(this).find('td:eq(6) .approval-badge').hasClass('approval-pending') ||
                        $(this).find('td:eq(6) .approval-badge').text().trim().toLowerCase() === 'pending';
                }).length;

                const approvedRows = $(table.rows().nodes()).filter(function() {
                    return $(this).find('td:eq(6) .approval-badge').hasClass('approval-approved') ||
                        $(this).find('td:eq(6) .approval-badge').text().trim().toLowerCase() === 'approved';
                }).length;

                const rejectedRows = $(table.rows().nodes()).filter(function() {
                    return $(this).find('td:eq(6) .approval-badge').hasClass('approval-rejected') ||
                        $(this).find('td:eq(6) .approval-badge').text().trim().toLowerCase() === 'rejected';
                }).length;

                // Update the stats with actual data
                $('.stat-value').eq(0).text(totalRows);
                $('.stat-value').eq(1).text(pendingRows);
                $('.stat-value').eq(2).text(approvedRows);
                $('.stat-value').eq(3).text(rejectedRows);

                // Initialize for filter changes
                let totalCount = totalRows;
                let pendingCount = pendingRows;
                let approvedCount = approvedRows;
                let rejectedCount = rejectedRows;

                // Update stats based on filtering
                $('#filter-department, #filter-team, #filter-status, #filter-approval').on('change', function() {
                    setTimeout(function() {
                        const visibleRows = table.rows({
                            search: 'applied'
                        }).nodes().length;
                        const pendingRows = $(table.rows({
                            search: 'applied'
                        }).nodes()).filter(function() {
                            return $(this).find('td:eq(6) .approval-badge').hasClass(
                                    'approval-pending') ||
                                $(this).find('td:eq(6) .approval-badge').text().trim()
                                .toLowerCase() === 'pending';
                        }).length;

                        const approvedRows = $(table.rows({
                            search: 'applied'
                        }).nodes()).filter(function() {
                            return $(this).find('td:eq(6) .approval-badge').hasClass(
                                    'approval-approved') ||
                                $(this).find('td:eq(6) .approval-badge').text().trim()
                                .toLowerCase() === 'approved';
                        }).length;

                        const rejectedRows = $(table.rows({
                            search: 'applied'
                        }).nodes()).filter(function() {
                            return $(this).find('td:eq(6) .approval-badge').hasClass(
                                    'approval-rejected') ||
                                $(this).find('td:eq(6) .approval-badge').text().trim()
                                .toLowerCase() === 'rejected';
                        }).length;

                        // Animate numbers change
                        animateValue($('.stat-value').eq(0), totalCount, visibleRows, 500);
                        animateValue($('.stat-value').eq(1), pendingCount, pendingRows, 500);
                        animateValue($('.stat-value').eq(2), approvedCount, approvedRows, 500);
                        animateValue($('.stat-value').eq(3), rejectedCount, rejectedRows, 500);

                        totalCount = visibleRows;
                        pendingCount = pendingRows;
                        approvedCount = approvedRows;
                        rejectedCount = rejectedRows;
                    }, 100);
                });
            }

            // Call the function to update dashboard stats
            updateDashboardStats();

            // Number animation function
            function animateValue(obj, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.text(Math.floor(progress * (end - start) + start));
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }
        });
    </script>
</body>

</html>
