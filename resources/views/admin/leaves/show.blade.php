
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Cuti</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --approved-color: #27ae60;
            --pending-color: #f39c12;
            --rejected-color: #e74c3c;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }

        .leave-status {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        
        .status-approved {
            background-color: var(--approved-color);
            color: white;
        }
        
        .status-pending {
            background-color: var(--pending-color);
            color: white;
        }
        
        .status-rejected {
            background-color: var(--rejected-color);
            color: white;
        }
        
        .info-group {
            margin-bottom: 15px;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            padding-left: 15px;
        }
        
        .info-group:hover {
            border-left-color: var(--secondary-color);
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .info-label {
            color: #6c757d;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 500;
        }
        
        .btn-action {
            border-radius: 30px;
            padding: 8px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-right: 10px;
        }
        
        .btn-approve {
            background-color: var(--approved-color);
            border-color: var(--approved-color);
            color: white;
        }
        
        .btn-approve:hover {
            background-color: #219a52;
            border-color: #219a52;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-reject {
            background-color: var(--rejected-color);
            border-color: var(--rejected-color);
            color: white;
        }
        
        .btn-reject:hover {
            background-color: #d63031;
            border-color: #d63031;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-back {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 8px 25px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background-color: #1e2b38;
            border-color: #1e2b38;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .leave-date {
            background-color: #f8f9fa;
            border-left: 4px solid var(--secondary-color);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .leave-date-icon {
            color: var(--secondary-color);
            font-size: 24px;
            margin-right: 10px;
        }
        
        .leave-reason {
            background-color: #f8f9fa;
            border-left: 4px solid var(--accent-color);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 25px 0;
        }
        
        .employee-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .employee-avatar {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }
        
        .employee-details {
            flex-grow: 1;
        }
        
        .employee-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .employee-id {
            color: #6c757d;
            font-size: 14px;
        }
        
        .badge-type {
            background-color: var(--secondary-color);
            color: white;
            border-radius: 20px;
            padding: 5px 15px;
            font-weight: 600;
            display: inline-block;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header position-relative">
                        <h2 class="mb-0"><i class="fas fa-calendar-alt me-2"></i> Detail Cuti</h2>
                        <div class="leave-status 
                            {{ $leave->approved_manager === 'approved' ? 'status-approved' : 
                              ($leave->approved_manager === 'pending' ? 'status-pending' : 'status-rejected') }}">
                            <i class="fas {{ $leave->approved_manager === 'approved' ? 'fa-check-circle' : 
                                   ($leave->approved_manager === 'pending' ? 'fa-clock' : 'fa-times-circle') }}"></i>
                            {{ ucfirst($leave->approved_manager) }}
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="employee-info">
                            <div class="employee-avatar">
                                {{ strtoupper(substr($leave->user->nama ?? 'User', 0, 1)) }}
                            </div>
                            <div class="employee-details">
                                <h4 class="employee-name">{{ $leave->user->nama ?? '-' }}</h4>
                                <div class="employee-id">{{ $leave->nip }}</div>
                                <div class="badge-type mt-2">{{ ucfirst($leave->type) }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-building me-1"></i> Departemen</div>
                                    <div class="info-value">{{ $leave->user->departement ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-users me-1"></i> Tim</div>
                                    <div class="info-value">{{ $leave->user->team_departement ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label"><i class="fas fa-user-tie me-1"></i> Manager</div>
                            <div class="info-value">{{ $leave->user->manager_departement ?? '-' }}</div>
                        </div>

                        <div class="divider"></div>

                        <div class="leave-date">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-week leave-date-icon"></i>
                                <div>
                                    <div class="info-label">Tanggal Cuti</div>
                                    <div class="info-value">
                                        {{ $leave->tanggal_mulai }} s/d {{ $leave->tanggal_selesai }}
                                        <span class="badge bg-secondary ms-2">
                                            <?php
                                            // Mengasumsikan format tanggal Y-m-d
                                            $date1 = new DateTime($leave->tanggal_mulai);
                                            $date2 = new DateTime($leave->tanggal_selesai);
                                            $diff = $date1->diff($date2);
                                            echo $diff->days + 1 . ' hari';
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="leave-reason">
                            <div class="info-label"><i class="fas fa-comment-alt me-1"></i> Alasan Cuti</div>
                            <div class="info-value">{{ $leave->alasan }}</div>
                        </div>

                        @if ($leave->approved_manager === 'pending')
                        <div class="divider"></div>
                        <div class="action-buttons">
                            <form method="POST" action="{{ route('admin.leaves.updateStatus', $leave->id) }}" class="d-flex justify-content-center">
                                @csrf
                                <button type="submit" name="approved_manager" value="approved" class="btn btn-action btn-approve me-3">
                                    <i class="fas fa-check me-2"></i> Setujui
                                </button>
                                <button type="submit" name="approved_manager" value="rejected" class="btn btn-action btn-reject">
                                    <i class="fas fa-times me-2"></i> Tolak
                                </button>
                            </form>
                        </div>
                        @endif

                        <div class="text-center mt-4">
                            <a href="{{ route('admin.leaves.index') }}" class="btn btn-back">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menambahkan beberapa efek interaktif
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi untuk card saat halaman dimuat
            const card = document.querySelector('.card');
            setTimeout(() => {
                card.style.opacity = '1';
            }, 200);
            
            // Tooltip untuk tombol
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>