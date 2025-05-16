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
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-welcome {
            display: flex;
            align-items: center;
        }

        .user-welcome .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: white;
            font-size: 24px;
        }

        .user-welcome .user-info h1 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .user-welcome .user-info p {
            color: #666;
            font-size: 14px;
        }

        .welcome-gif {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            overflow: hidden;
        }

        .welcome-gif img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .success-alert {
            background-color: rgba(76, 201, 240, 0.1);
            border-left: 4px solid var(--success);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            animation: fadeIn 0.5s ease;
        }

        .success-alert i {
            color: var(--success);
            margin-right: 10px;
            font-size: 20px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: center;
            size: 40cm
        }

        .nav-btn {
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 14px;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .nav-btn:hover {
            background-color: var(--secondary);
        }

        .nav-btn i {
            margin-right: 8px;
        }

    .logout-btn {
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 4px;
        background-color: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    .logout-btn i {
        font-size: 18px;
    }
        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 22px;
            color: white;
        }

        .card-user { background-color: var(--primary); }
        .card-attendance { background-color: var(--warning); }
        .card-leave { background-color: var(--info); }

        .card-content h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .card-content p {
            font-size: 12px;
            color: #777;
        }

        .user-table-section {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 18px;
            color: var(--dark);
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: #f5f7fb;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .search-box input {
            border: none;
            background: transparent;
            padding: 5px;
            outline: none;
        }

        .search-box i {
            color: #777;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th, .user-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .user-table thead th {
            background-color: #f8f9fa;
            color: #666;
            font-weight: 600;
            font-size: 14px;
        }

        .user-table tbody tr {
            transition: all 0.3s ease;
        }

        .user-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .user-table tbody td {
            font-size: 14px;
        }

        .role-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .role-admin {
            background-color: rgba(243, 80, 114, 0.1);
            color: #f35072;
        }

        .role-user {
            background-color: rgba(76, 201, 240, 0.1);
            color: #4cc9f0;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            list-style: none;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a {
            display: flex;
            width: 30px;
            height: 30px;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            text-decoration: none;
            color: var(--dark);
            font-size: 14px;
            background-color: #f5f7fb;
            transition: all 0.3s ease;
        }

        .pagination a:hover, .pagination a.active {
            background-color: var(--primary);
            color: white;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .action-cards {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .welcome-gif {
                display: none;
            }
            
            .user-table {
                display: block;
                overflow-x: auto;
            }
            
            .nav-buttons {
                flex-wrap: wrap;
            }
            
            .nav-btn, .logout-btn {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Main Content -->
        <div class="main-content">
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
                        <h1>Halo, {{ $nama }}</h1>
                        <p>Selamat datang di dashboard admin.</p>
                        <p>Role: <strong>{{ $role }}</strong></p>
                </form>
            </div>
                </div>
                <div class="nav-buttons">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </div>
            </div>
            <div class="action-cards">
                <div class="card" onclick="location.href='{{ route('admin.create.user.form') }}'">
                    <div class="card-icon card-user">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="card-content">
                        <h3>Buat User Baru</h3>
                        <p>Tambahkan pengguna ke sistem</p>
                    </div>
                </div>
                
                <div class="card" onclick="location.href='{{ route('admin.attendances') }}'">
                    <div class="card-icon card-attendance">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-content">
                        <h3>Data Attendance</h3>
                        <p>Lihat kehadiran pegawai</p>
                    </div>
                </div>
                
                <div class="card" onclick="location.href='{{ route('admin.leaves.index') }}'">
                    <div class="card-icon card-leave">
                        <i class="fas fa-calendar-minus"></i>
                    </div>
                    <div class="card-content">
                        <h3>Data Cuti</h3>
                        <p>Kelola pengajuan cuti</p>
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
                            <th>Departement</th>
                            <th>Team Departement</th>
                            <th>Manager Departement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr>
                                <td>{{ $u->nip }}</td>
                                <td>{{ $u->nama }}</td>
                                <td>
                                    <span class="role-badge {{ $u->role == 'admin' ? 'role-admin' : 'role-user' }}">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td>{{ $u->departement }}</td>
                                <td>{{ $u->team_departement }}</td>
                                <td>{{ $u->manager_departement }}</td>
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
        
        // Add fade-in animation for cards
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * (index + 1));
        });
    </script>
</body>
</html>