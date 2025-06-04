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
            --light-bg: #f8f9fa;
            --shadow-light: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 4px 16px rgba(0, 0, 0, 0.12);
            --shadow-heavy: 0 8px 32px rgba(0, 0, 0, 0.16);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .card {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: var(--shadow-heavy);
            transition: var(--transition);
            background: white;
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%);
            color: white;
            border-radius: 0;
            padding: 24px 28px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .card-header:hover::before {
            transform: translateX(100%);
        }

        .card-header h2 {
            position: relative;
            z-index: 2;
            margin: 0;
            font-weight: 600;
            font-size: 24px;
        }

        .leave-status {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.2);
            z-index: 3;
            transition: var(--transition);
        }

        .leave-status:hover {
            transform: scale(1.05);
        }

        .status-approved {
            background: linear-gradient(135deg, var(--approved-color), #2ecc71);
            color: white;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .status-pending {
            background: linear-gradient(135deg, var(--pending-color), #e67e22);
            color: white;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }

        .status-rejected {
            background: linear-gradient(135deg, var(--rejected-color), #c0392b);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .card-body {
            padding: 32px;
        }

        .employee-info {
            display: flex;
            align-items: center;
            margin-bottom: 32px;
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .employee-info:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .employee-avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 600;
            margin-right: 20px;
            box-shadow: var(--shadow-medium);
            transition: var(--transition);
        }

        .employee-avatar:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .employee-details {
            flex-grow: 1;
        }

        .employee-name {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--primary-color);
        }

        .employee-id {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .badge-type {
            background: linear-gradient(135deg, var(--secondary-color), #5dade2);
            color: white;
            border-radius: 20px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: 12px;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .badge-type:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .info-group {
            margin-bottom: 20px;
            padding: 16px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            border-left: 4px solid transparent;
            background: white;
        }

        .info-group:hover {
            border-left-color: var(--secondary-color);
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.03), rgba(52, 152, 219, 0.08));
            transform: translateX(4px);
            box-shadow: var(--shadow-light);
        }

        .info-label {
            color: #6c757d;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: var(--primary-color);
        }

        .divider {
            height: 2px;
            background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
            margin: 32px 0;
            border-radius: 1px;
            opacity: 0.3;
        }

        .leave-date,
        .leave-reason,
        .leave-proof {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-left: 4px solid var(--secondary-color);
            padding: 20px;
            margin-bottom: 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }

        .leave-reason {
            border-left-color: var(--accent-color);
        }

        .leave-proof {
            border-left-color: var(--approved-color);
        }

        .leave-date:hover,
        .leave-reason:hover,
        .leave-proof:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .leave-date-icon {
            color: var(--secondary-color);
            font-size: 28px;
            margin-right: 16px;
        }

        .btn-action {
            border-radius: 30px;
            padding: 12px 32px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            border: none;
            margin: 0 8px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-action:hover::before {
            left: 100%;
        }

        .btn-approve {
            background: linear-gradient(135deg, var(--approved-color), #2ecc71);
            color: white;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .btn-approve:hover {
            background: linear-gradient(135deg, #219a52, var(--approved-color));
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
        }

        .btn-reject {
            background: linear-gradient(135deg, var(--rejected-color), #c0392b);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-reject:hover {
            background: linear-gradient(135deg, #d63031, var(--rejected-color));
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }

        .btn-back {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            padding: 12px 32px;
            border-radius: 30px;
            transition: var(--transition);
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-back:hover::before {
            left: 100%;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #1e2b38, var(--primary-color));
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(44, 62, 80, 0.4);
        }

        .action-buttons {
            text-align: center;
            margin-top: 24px;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
        }

        .leave-proof img {
            max-width: 100%;
            height: auto;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-medium);
            transition: var(--transition);
        }

        .leave-proof img:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-heavy);
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .employee-info {
                flex-direction: column;
                text-align: center;
            }
            
            .employee-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .leave-status {
                position: relative;
                top: auto;
                right: auto;
                margin-top: 15px;
                display: inline-block;
            }
            
            .card-header {
                text-align: center;
            }
            
            .btn-action {
                width: 100%;
                margin: 5px 0;
            }
        }

        /* Loading animation */
        .loading {
            opacity: 0;
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        /* Micro-interactions */
        .info-group .fas {
            transition: var(--transition);
        }

        .info-group:hover .fas {
            transform: scale(1.1);
            color: var(--secondary-color);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card loading">
                    <div class="card-header position-relative">
                        <h2 class="mb-0">
                            <i class="fas fa-calendar-alt me-2"></i> 
                            Detail Cuti
                        </h2>
                        <div class="leave-status 
                            {{ $leave->status === 'approved'
                                ? 'status-approved'
                                : ($leave->status === 'pending'
                                    ? 'status-pending'
                                    : 'status-rejected') }}">
                            <i class="fas {{ $leave->status === 'approved'
                                    ? 'fa-check-circle'
                                    : ($leave->status === 'pending'
                                        ? 'fa-clock'
                                        : 'fa-times-circle') }}"></i>
                            {{ ucfirst($leave->status) }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="employee-info">
                            <div class="employee-avatar">
                                {{ strtoupper(substr($leave->user->name ?? 'User', 0, 1)) }}
                            </div>
                            <div class="employee-details">
                                <h4 class="employee-name">{{ $leave->user->name ?? '-' }}</h4>
                                <div class="employee-id">ID: {{ $leave->user->nip }}</div>
                                <div class="badge-type">{{ ucfirst($leave->type) }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">
                                        <i class="fas fa-building me-1"></i> 
                                        Departemen
                                    </div>
                                    <div class="info-value">
                                        {{ $leave->user->teamDepartment->department->department ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label">
                                        <i class="fas fa-users me-1"></i> 
                                        Tim
                                    </div>
                                    <div class="info-value">
                                        {{ $leave->user->teamDepartment->name ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="fas fa-user-tie me-1"></i> 
                                Manager
                            </div>
                            <div class="info-value">
                                {{ $leave->user->teamDepartment->department->manager_department ?? '-' }}
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="leave-date">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-week leave-date-icon"></i>
                                <div>
                                    <div class="info-label">Tanggal Cuti</div>
                                    <div class="info-value">
                                        {{ $leave->start_date }} s/d {{ $leave->end_date }}
                                        <span class="badge bg-secondary ms-2">
                                            {{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}
                                            hari
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="leave-reason">
                            <div class="info-label">
                                <i class="fas fa-comment-alt me-1"></i> 
                                Alasan Cuti
                            </div>
                            <div class="info-value">{{ $leave->reason ?? '-' }}</div>
                        </div>

                        @if ($leave->proof_file)
                            <div class="leave-proof">
                                <div class="info-label">
                                    <i class="fas fa-file-image me-1"></i> 
                                    Bukti Cuti
                                </div>
                                <div class="info-value">
                                    <img src="{{ $leave->proof_file }}" alt="Bukti Cuti">
                                </div>
                            </div>
                        @endif

                        @if ($leave->status === 'pending')
                            <div class="divider"></div>
                            <div class="action-buttons">
                                <form method="POST" action="{{ route('admin.leaves.updateStatus', $leave->id) }}">
                                    @csrf
                                    <button type="submit" name="status" value="approved" class="btn btn-action btn-approve">
                                        <i class="fas fa-check me-2"></i> 
                                        Setujui
                                    </button>
                                    <button type="submit" name="status" value="rejected" class="btn btn-action btn-reject">
                                        <i class="fas fa-times me-2"></i> 
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div class="text-center mt-4">
                            <a href="{{ route('admin.leaves.index') }}" class="btn btn-back">
                                <i class="fas fa-arrow-left me-2"></i> 
                                Kembali ke Daftar
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
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced loading animation
            const card = document.querySelector('.card');
            setTimeout(() => {
                card.classList.add('loading');
            }, 100);

            // Enhanced button interactions
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });

                // Add click effect
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'translateY(-1px) scale(0.98)';
                });
                
                button.addEventListener('mouseup', function() {
                    this.style.transform = 'translateY(-3px)';
                });
            });

            // Smooth scrolling for better UX
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Add subtle parallax effect to background
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                document.body.style.backgroundPosition = `center ${rate}px`;
            });

            // Add intersection observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe info groups for staggered animation
            document.querySelectorAll('.info-group').forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                group.style.transition = `all 0.6s ease ${index * 0.1}s`;
                observer.observe(group);
            });
        });
    </script>
</body>

</html>