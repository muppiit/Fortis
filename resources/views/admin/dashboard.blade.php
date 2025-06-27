<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            --purple: #7209b7;
            --orange: #ff6b35;
            --teal: #20b2aa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .dashboard-container {
            min-height: 100vh;
            width: 100%;
        }

        /* Main Content Styles */
        .main-content {
            width: 100%;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-welcome {
            display: flex;
            align-items: center;
        }

        .user-welcome .user-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: white;
            font-size: 28px;
            box-shadow: 0 4px 15px rgba(77, 149, 239, 0.3);
        }

        .user-welcome .user-info h1 {
            font-size: 24px;
            margin-bottom: 5px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .user-welcome .user-info p {
            color: #666;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .success-alert {
            background: rgba(76, 201, 240, 0.15);
            backdrop-filter: blur(10px);
            border-left: 4px solid var(--success);
            padding: 18px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            animation: slideInFromTop 0.6s ease;
            box-shadow: 0 4px 15px rgba(76, 201, 240, 0.2);
        }

        .success-alert i {
            color: var(--success);
            margin-right: 12px;
            font-size: 22px;
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logout-btn {
            font-size: 16px;
            padding: 12px 24px;
            border-radius: 12px;
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        }

        .logout-btn i {
            font-size: 18px;
        }

        /* Improved Action Cards */
        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .card:hover::before {
            left: 100%;
        }

        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .card-content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .card-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-size: 20px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card:hover .card-icon {
            transform: rotate(10deg) scale(1.1);
        }

        /* Specific card icon styles */
        .card-user {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .card-role {
            background: linear-gradient(135deg, var(--purple), #a663cc);
        }

        .card-department {
            background: linear-gradient(135deg, var(--info), var(--accent));
        }

        .card-team {
            background: linear-gradient(135deg, var(--teal), #48cae4);
        }

        .card-attendance {
            background: linear-gradient(135deg, var(--warning), var(--orange));
        }

        .card-leave {
            background: linear-gradient(135deg, var(--success), var(--info));
        }

        .card-content {
            flex: 1;
        }

        .card-content h3 {
            font-size: 14px;
            margin-bottom: 5px;
            color: var(--dark);
            font-weight: 600;
            line-height: 1.2;
        }

        .card-content p {
            font-size: 11px;
            color: #666;
            line-height: 1.3;
            margin: 0;
        }

        .card-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            padding: 2px 6px;
            border-radius: 6px;
            font-size: 8px;
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Table Section Improvements */
        .user-table-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header h2 {
            font-size: 22px;
            color: var(--dark);
            font-weight: 600;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: rgba(245, 247, 251, 0.8);
            border-radius: 12px;
            padding: 8px 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .search-box input {
            border: none;
            background: transparent;
            padding: 8px;
            outline: none;
            font-size: 14px;
        }

        .search-box i {
            color: #777;
            margin-right: 8px;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
        }

        .user-table th,
        .user-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .user-table thead th {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #555;
            font-weight: 600;
            font-size: 14px;
        }

        .user-table tbody tr {
            transition: all 0.3s ease;
        }

        .user-table tbody tr:hover {
            background: rgba(67, 97, 238, 0.05);
            transform: scale(1.01);
        }

        .user-table tbody td {
            font-size: 14px;
        }

        .role-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .role-admin {
            background: linear-gradient(135deg, rgba(243, 80, 114, 0.15), rgba(243, 80, 114, 0.1));
            color: #f35072;
            border: 1px solid rgba(243, 80, 114, 0.2);
        }

        .role-user {
            background: linear-gradient(135deg, rgba(76, 201, 240, 0.15), rgba(76, 201, 240, 0.1));
            color: #4cc9f0;
            border: 1px solid rgba(76, 201, 240, 0.2);
        }

        .role-super_super_admin {
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.15), rgba(67, 97, 238, 0.1));
            color: var(--primary);
            border: 1px solid rgba(67, 97, 238, 0.2);
        }

        /* Action Buttons Improvements */
        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            position: relative;
            overflow: hidden;
        }

        .btn i {
            font-size: 12px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 11px;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #e6a200);
            color: #fff;
            box-shadow: 0 2px 8px rgba(255, 183, 3, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 183, 3, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #d12b36);
            color: #fff;
            box-shadow: 0 2px 8px rgba(230, 57, 70, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.4);
        }

        .action-form {
            display: inline-block;
        }

        /* Pagination Improvements */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            list-style: none;
            gap: 8px;
        }

        .pagination li a {
            display: flex;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            text-decoration: none;
            color: var(--dark);
            font-size: 14px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .pagination li a:hover,
        .pagination li a.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        /* Responsive Improvements */
        @media (max-width: 768px) {
            .action-cards {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 12px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .user-table-section {
                padding: 20px;
            }

            .user-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .action-buttons {
                flex-direction: column;
                gap: 6px;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .card {
                padding: 12px;
                min-height: 100px;
            }

            .card-icon {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }

            .card-content h3 {
                font-size: 12px;
            }

            .card-content p {
                font-size: 10px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 20px;
            }

            .action-cards {
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 10px;
            }

            .user-table th,
            .user-table td {
                padding: 10px 8px;
                font-size: 12px;
            }

            .btn {
                font-size: 10px;
                padding: 6px 10px;
            }

            .card {
                padding: 10px;
                min-height: 90px;
            }

            .card-content h3 {
                font-size: 11px;
            }

            .card-content p {
                font-size: 9px;
            }

            .card-icon {
                width: 30px;
                height: 30px;
                font-size: 14px;
            }
        }

        /* Animation for card entrance */
        .card {
            opacity: 0;
            transform: translateY(30px);
            animation: cardFadeIn 0.6s ease forwards;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }

        @keyframes cardFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Ripple effect for buttons */
        .btn {
            position: relative;
            overflow: hidden;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="main-content">
            <!-- Success Alert -->
            @if (session('success'))
                <div class="success-alert">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="header">
                <div class="user-welcome">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <h1>Halo, {{ auth()->user()->name }}</h1>
                        <p>Selamat datang di dashboard admin.</p>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <div class="action-cards">
                @if (auth()->user()->role->level === 'super_super_admin')
                    <div class="card" onclick="location.href='{{ route('admin.roles.index') }}'">
                        <div class="card-content-wrapper">
                            <div class="card-icon card-role">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div class="card-content">
                                <h3>Kelola Role</h3>
                                <p>Manajemen data role sistem dan pengaturan hak akses pengguna</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->role->level === 'super_super_admin')
                    <div class="card" onclick="location.href='{{ route('admin.departments.index') }}'">
                        <div class="card-content-wrapper">
                            <div class="card-icon card-department">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="card-content">
                                <h3>Manajemen Departemen</h3>
                                <p>Lihat dan atur departemen serta struktur organisasi</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (in_array(auth()->user()->role->level, ['super_super_admin', 'super_admin']))
                    <div class="card" onclick="location.href='{{ route('admin.team_departments.index') }}'">
                        <div class="card-content-wrapper">
                            <div class="card-icon card-team">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-content">
                                <h3>Team Departemen</h3>
                                <p>Kelola struktur tim per departemen dan koordinasi</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card" onclick="location.href='{{ route('admin.create-user') }}'">
                    <div class="card-content-wrapper">
                        <div class="card-icon card-user">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="card-content">
                            <h3>Buat User Baru</h3>
                            <p>Tambahkan pengguna baru ke dalam sistem</p>
                        </div>
                    </div>
                </div>

                <div class="card" onclick="location.href='{{ route('admin.attendances.index') }}'">
                    <div class="card-content-wrapper">
                        <div class="card-icon card-attendance">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="card-content">
                            <h3>Data Attendance</h3>
                            <p>Lihat dan kelola data kehadiran semua pegawai</p>
                        </div>
                    </div>
                </div>

                <div class="card" onclick="location.href='{{ route('admin.leaves.index') }}'">
                    <div class="card-content-wrapper">
                        <div class="card-icon card-leave">
                            <i class="fas fa-calendar-minus"></i>
                        </div>
                        <div class="card-content">
                            <h3>Data Cuti</h3>
                            <p>Kelola pengajuan cuti dan permohonan izin</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-table-section">
                <div class="section-header">
                    <h2>Daftar User dan Admin</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Cari user...">
                    </div>
                </div>

                <table class="user-table" id="userTable">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Departemen</th>
                            <th>Team Departemen</th>
                            <th>Manager Departemen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr>
                                <td>{{ $u->nip }}</td>
                                <td>{{ $u->name }}</td>
                                <td>
                                    <span class="role-badge role-{{ $u->role->level }}">
                                        {{ $u->role->level }}
                                    </span>
                                </td>
                                <td>{{ $u->teamDepartment->department->department ?? '-' }}</td>
                                <td>{{ $u->teamDepartment->name ?? '-' }}</td>
                                <td>{{ $u->teamDepartment->department->manager_department ?? '-' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.edit-user', $u->nip) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.delete-user', $u->nip) }}" method="POST"
                                            class="action-form"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <ul class="pagination">
                    <li><a href="#"><i class="fas fa-chevron-left"></i></a></li>
                    <li><a href="#" class="active">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const userTable = document.getElementById('userTable');
        const rows = userTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();

            for (let i = 0; i < rows.length; i++) {
                let found = false;
                const cells = rows[i].getElementsByTagName('td');

                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();

                    if (cellText.indexOf(searchTerm) > -1) {
                        found = true;
                        break;
                    }
                }

                if (found) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });

        // Success alert fade out
        const successAlert = document.querySelector('.success-alert');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.opacity = '0';
                successAlert.style.transition = 'opacity 0.5s ease';
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 500);
            }, 5000);
        }

        // Add click effect for buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.height, rect.width);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add smooth scroll behavior for card clicks
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Add subtle click animation
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>

</html>