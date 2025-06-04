<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Role</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f9ff;
            color: #2d3748;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }

        /* Container */
        .role-management {
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 62, 155, 0.08);
        }

        /* Header Section */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9f0ff;
        }

        h1 {
            color: #1a56db;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h1 svg {
            color: #1a56db;
        }

        /* Button Styles */
        .button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #1a56db;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(26, 86, 219, 0.2);
        }

        .button:hover {
            background-color: #1e429f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(26, 86, 219, 0.3);
        }

        .button:active {
            transform: translateY(0);
        }

        .button svg {
            width: 18px;
            height: 18px;
        }

        /* Success Message */
        .success-message {
            background-color: #e6f7ef;
            color: #057a55;
            padding: 15px 20px;
            border-left: 4px solid #057a55;
            border-radius: 6px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 62, 155, 0.06);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            overflow: hidden;
        }

        th, td {
            padding: 16px 20px;
            text-align: left;
        }

        th {
            background-color: #f0f7ff;
            color: #1a56db;
            font-weight: 600;
            font-size: 15px;
            position: relative;
            transition: background-color 0.2s;
        }

        th:hover {
            background-color: #e6f0ff;
        }

        tr {
            transition: all 0.2s;
        }

        tbody tr:hover {
            background-color: #f9fbff;
        }

        tbody tr:not(:last-child) {
            border-bottom: 1px solid #edf2f7;
        }

        /* Badge Styles */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            color: rgb(0, 0, 0);
            text-align: center;
            min-width: 80px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .badge.level-1 { background-color: #3b82f6; }
        .badge.level-2 { background-color: #0ea5e9; }
        .badge.level-3 { background-color: #10b981; }
        .badge.level-4 { background-color: #f59e0b; }
        .badge.level-5 { background-color: #ef4444; }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            text-decoration: none;
        }

        .edit-btn {
            background-color: #e6f0ff;
            color: #1a56db;
        }

        .edit-btn:hover {
            background-color: #d1e2ff;
        }

        .delete-btn {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .delete-btn:hover {
            background-color: #fecaca;
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            color: #1a56db;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            padding: 8px 0;
        }

        .back-link:hover {
            color: #1e429f;
            transform: translateX(-3px);
        }

        /* Delete Confirmation Modal */
        .delete-confirm {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .delete-confirm.active {
            opacity: 1;
            visibility: visible;
        }

        .delete-confirm-content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-20px);
            transition: all 0.3s;
        }

        .delete-confirm.active .delete-confirm-content {
            transform: translateY(0);
        }

        .delete-confirm h3 {
            margin-top: 0;
            color: #1a56db;
        }

        .delete-confirm-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .confirm-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .confirm-yes {
            background-color: #ef4444;
            color: white;
        }

        .confirm-yes:hover {
            background-color: #dc2626;
        }

        .confirm-no {
            background-color: #e5e7eb;
            color: #4b5563;
        }

        .confirm-no:hover {
            background-color: #d1d5db;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: right;
                border-bottom: 1px solid #edf2f7;
            }

            td:last-child {
                border-bottom: none;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 20px;
                width: 45%;
                padding-right: 10px;
                text-align: left;
                font-weight: 600;
                color: #4a5568;
            }

            .actions {
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="role-management">
        <div class="header-section">
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Daftar Role
            </h1>
            <a href="{{ route('admin.roles.create') }}" class="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Role
            </a>
        </div>

        @if (session('success'))
            <div class="success-message">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td data-label="ID">{{ $role->id }}</td>
                            <td data-label="Nama">{{ $role->name }}</td>
                            <td data-label="Level">
                                <span class="badge level-{{ $role->level }}">Level {{ $role->level }}</span>
                            </td>
                            <td data-label="Aksi" class="actions">
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="action-btn edit-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.roles.delete', $role->id) }}" method="POST" style="display:inline" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Dashboard
        </a>

        <!-- Delete Confirmation Modal -->
        <div id="deleteConfirm" class="delete-confirm">
            <div class="delete-confirm-content">
                <h3>Konfirmasi Hapus</h3>
                <p>Apakah Anda yakin ingin menghapus role ini?</p>
                <div class="delete-confirm-buttons">
                    <button id="confirmYes" class="confirm-btn confirm-yes">
                        Ya, Hapus
                    </button>
                    <button id="confirmNo" class="confirm-btn confirm-no">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to handle delete confirmation
        let currentForm = null;
        
        function confirmDelete(button) {
            currentForm = button.closest('form');
            const modal = document.getElementById('deleteConfirm');
            modal.classList.add('active');
        }
        
        // Set up event listeners when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            const confirmYes = document.getElementById('confirmYes');
            const confirmNo = document.getElementById('confirmNo');
            const modal = document.getElementById('deleteConfirm');
            
            // Handle confirm delete
            confirmYes.addEventListener('click', function() {
                if (currentForm) {
                    currentForm.submit();
                }
                modal.classList.remove('active');
            });
            
            // Handle cancel delete
            confirmNo.addEventListener('click', function() {
                modal.classList.remove('active');
            });
            
            // Close modal if clicked outside content
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
            
            // Add row hover effect with subtle animation
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.05)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });
            
            // Auto-hide success message after 5 seconds
            const successMessage = document.querySelector('.success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 500);
                }, 5000);
            }
            
            // Add smooth scroll behavior for back link
            const backLink = document.querySelector('.back-link');
            if (backLink) {
                backLink.addEventListener('click', function(e) {
                    // Add a subtle animation before navigation
                    this.style.transform = 'translateX(-5px)';
                    setTimeout(() => {
                        this.style.transform = 'translateX(0)';
                    }, 150);
                });
            }
        });
        
        // Add keyboard support for modal
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('deleteConfirm');
            if (modal.classList.contains('active')) {
                if (e.key === 'Escape') {
                    modal.classList.remove('active');
                } else if (e.key === 'Enter') {
                    document.getElementById('confirmYes').click();
                }
            }
        });
    </script>
</body>
</html>
