<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Cuti</title>
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
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
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
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
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
            gap: 15px;
        }

        .page-title i {
            font-size: 32px;
            color: var(--primary);
            background-color: rgba(67, 97, 238, 0.1);
            padding: 10px;
            border-radius: 10px;
        }

        .leave-card {
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
            position: relative;
        }

        .card-header h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .leave-type-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .card-body {
            padding: 25px;
        }

        .leave-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-group {
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 13px;
            text-transform: uppercase;
            color: var(--gray-600);
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: var(--dark);
        }

        .reason-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed var(--gray-300);
        }

        .reason-content {
            background-color: var(--gray-100);
            padding: 15px;
            border-radius: 8px;
            font-size: 15px;
            margin-top: 10px;
            border-left: 4px solid var(--primary);
        }

        .status-section {
            margin-top: 25px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f8f9ff;
        }

        .status-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .status-title {
            font-size: 16px;
            font-weight: 600;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .status-pending {
            background-color: rgba(255, 183, 3, 0.2);
            color: #d68c00;
        }

        .status-approved {
            background-color: rgba(46, 204, 113, 0.2);
            color: #27ae60;
        }

        .status-rejected {
            background-color: rgba(231, 76, 60, 0.2);
            color: #c0392b;
        }

        .approval-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .approval-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .approve-btn {
            background-color: rgba(46, 204, 113, 0.9);
            color: white;
        }

        .approve-btn:hover {
            background-color: rgba(46, 204, 113, 1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
        }

        .reject-btn {
            background-color: rgba(231, 76, 60, 0.9);
            color: white;
        }

        .reject-btn:hover {
            background-color: rgba(231, 76, 60, 1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background-color: white;
            color: var(--gray-600);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .back-btn:hover {
            background-color: var(--gray-100);
            color: var(--dark);
            transform: translateX(-5px);
        }

        .date-range {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 5px;
        }

        .date-pill {
            background-color: var(--primary);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .date-separator {
            color: var(--gray-500);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 600;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .user-position {
            color: var(--gray-600);
            font-size: 14px;
        }

        .action-disabled {
            opacity: 0.7;
            pointer-events: none;
        }

        /* Confirmation Popup */
        .confirmation-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .confirmation-popup {
            background-color: white;
            border-radius: 12px;
            padding: 25px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: popIn 0.3s ease;
            position: relative;
        }

        @keyframes popIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .confirmation-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .confirmation-icon.approve {
            color: #27ae60;
        }

        .confirmation-icon.reject {
            color: #c0392b;
        }

        .confirmation-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .confirmation-message {
            color: var(--gray-600);
            margin-bottom: 20px;
        }

        .confirmation-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .confirmation-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }

        .confirm-yes {
            background-color: var(--primary);
            color: white;
        }

        .confirm-yes:hover {
            background-color: var(--secondary);
        }

        .confirm-no {
            background-color: var(--gray-200);
            color: var(--gray-700);
        }

        .confirm-no:hover {
            background-color: var(--gray-300);
        }

        .close-popup {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: var(--gray-500);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .leave-info {
                grid-template-columns: 1fr;
            }
            
            .approval-form {
                flex-direction: column;
            }
            
            .approval-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="page-title">
                <i class="fas fa-calendar-alt"></i>
                Detail Cuti
            </h1>
        </div>
        
        <div class="leave-card">
            <div class="card-header">
                <h2>Informasi Cuti</h2>
                <p>Detail lengkap pengajuan cuti karyawan</p>
                <div class="leave-type-badge">
                    <i class="fas fa-tag"></i> {{ ucfirst($leave->type) }}
                </div>
            </div>
            
            <div class="card-body">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ isset($leave->user->nama) ? substr($leave->user->nama, 0, 1) : '-' }}
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ $leave->user->nama ?? '-' }}</div>
                        <div class="user-position">{{ $leave->user->departement ?? '-' }} • {{ $leave->user->team_departement ?? '-' }}</div>
                    </div>
                </div>
                
                <div class="leave-info">
                    <div class="info-group">
                        <div class="info-label">ID Karyawan</div>
                        <div class="info-value">{{ $leave->nip }}</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Manager</div>
                        <div class="info-value">{{ $leave->user->manager_departement ?? '-' }}</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Jenis Cuti</div>
                        <div class="info-value">{{ ucfirst($leave->type) }}</div>
                    </div>
                    
                    <div class="info-group">
                        <div class="info-label">Periode Cuti</div>
                        <div class="info-value">
                            <div class="date-range">
                                <span class="date-pill">{{ $leave->tanggal_mulai }}</span>
                                <span class="date-separator">hingga</span>
                                <span class="date-pill">{{ $leave->tanggal_selesai }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="status-section">
                    <div class="status-header">
                        <div class="status-title">Status Persetujuan</div>
                        @if ($leave->approved_manager === 'pending')
                            <div class="status-badge status-pending">
                                <i class="fas fa-clock"></i> Menunggu Persetujuan
                            </div>
                        @elseif ($leave->approved_manager === 'approved')
                            <div class="status-badge status-approved">
                                <i class="fas fa-check-circle"></i> Disetujui
                            </div>
                        @elseif ($leave->approved_manager === 'rejected')
                            <div class="status-badge status-rejected">
                                <i class="fas fa-times-circle"></i> Ditolak
                            </div>
                        @endif
                    </div>
                    <div class="reason-section">
                    <div class="info-label">Alasan Cuti</div>
                    <div class="reason-content">
                        {{ $leave->alasan }}
                    </div>
                </div>
                </div>
            </div>
        </div>
        
        <a href="{{ route('admin.leaves.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Cuti
        </a>
    </div>
    
    <!-- Confirmation Overlay -->
    <div class="confirmation-overlay" id="confirmationOverlay">
        <div class="confirmation-popup" id="approveConfirmation">
            <div class="close-popup" onclick="hideConfirmation()">×</div>
            <div class="confirmation-icon approve">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="confirmation-title">Setujui Pengajuan Cuti</div>
            <div class="confirmation-message">
                Anda yakin ingin menyetujui pengajuan cuti ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="confirmation-buttons">
                <button type="button" class="confirmation-btn confirm-no" onclick="hideConfirmation()">Batal</button>
                <button type="button" class="confirmation-btn confirm-yes" onclick="submitForm('approved')">Ya, Setujui</button>
            </div>
        </div>
        
        <div class="confirmation-popup" id="rejectConfirmation" style="display: none;">
            <div class="close-popup" onclick="hideConfirmation()">×</div>
            <div class="confirmation-icon reject">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="confirmation-title">Tolak Pengajuan Cuti</div>
            <div class="confirmation-message">
                Anda yakin ingin menolak pengajuan cuti ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="confirmation-buttons">
                <button type="button" class="confirmation-btn confirm-no" onclick="hideConfirmation()">Batal</button>
                <button type="button" class="confirmation-btn confirm-yes" onclick="submitForm('rejected')">Ya, Tolak</button>
            </div>
        </div>
    </div>
    
    <script>
        function showConfirmation(type) {
            const overlay = document.getElementById('confirmationOverlay');
            const approveConfirmation = document.getElementById('approveConfirmation');
            const rejectConfirmation = document.getElementById('rejectConfirmation');
            
            overlay.style.display = 'flex';
            
            if (type === 'approve') {
                approveConfirmation.style.display = 'block';
                rejectConfirmation.style.display = 'none';
            } else {
                approveConfirmation.style.display = 'none';
                rejectConfirmation.style.display = 'block';
            }
        }
        
        function hideConfirmation() {
            document.getElementById('confirmationOverlay').style.display = 'none';
        }
        
        function submitForm(action) {
            const form = document.getElementById('approvalForm');
            
            // Create and append the hidden input
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'approved_manager';
            hiddenInput.value = action;
            form.appendChild(hiddenInput);
            
            // Submit the form
            form.submit();
        }
        
        // Close popup when clicking outside
        document.getElementById('confirmationOverlay').addEventListener('click', function(event) {
            if (event.target === this) {
                hideConfirmation();
            }
        });
    </script>
</body>
</html>