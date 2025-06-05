<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role</title>
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
        .role-edit {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 62, 155, 0.08);
        }

        /* Header Section */
        .header-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9f0ff;
        }

        h1 {
            color: #1a56db;
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        h1 svg {
            color: #1a56db;
        }

        /* Form Styles */
        .form-container {
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #1a56db;
            font-weight: 600;
            font-size: 15px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s ease;
            background-color: #ffffff;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.1);
            background-color: #f9fbff;
        }

        input[type="text"]:hover,
        select:hover {
            border-color: #3b82f6;
        }

        /* Select Dropdown Styling */
        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        select option {
            padding: 10px;
            background-color: white;
            color: #2d3748;
        }

        /* Button Styles */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #1a56db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1e429f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(26, 86, 219, 0.3);
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: #4b5563;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn svg {
            width: 18px;
            height: 18px;
        }

        /* Error Styles */
        .error-message {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 12px 16px;
            border-left: 4px solid #dc2626;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.5s ease-out;
        }

        .field-error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .field-error svg {
            width: 16px;
            height: 16px;
        }

        /* Success Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Loading State */
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Form Validation */
        .form-group.has-error input,
        .form-group.has-error select {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-group.has-success input,
        .form-group.has-success select {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .role-edit {
                margin: 10px;
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
                width: 100%;
            }
        }

        /* Focus Indicators for Accessibility */
        .btn:focus,
        input:focus,
        select:focus {
            outline: 2px solid #1a56db;
            outline-offset: 2px;
        }

        /* Hover Effects */
        .form-group {
            transition: all 0.2s ease;
        }

        .form-group:hover label {
            color: #1e429f;
        }

        /* Custom Scrollbar for Select */
        select::-webkit-scrollbar {
            width: 8px;
        }

        select::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        select::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        select::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>
<body>
    <div class="role-edit">
        <div class="header-section">
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Edit Role
            </h1>
        </div>

        <!-- Error Messages (if any) -->
        @if ($errors->any())
            <div class="error-message">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <div>
                    <strong>Terdapat kesalahan:</strong>
                    <ul style="margin: 5px 0 0 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" id="editRoleForm">
                @csrf
                @method('PUT')
                
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline; margin-right: 5px;">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Nama Role
                    </label>
                    <input 
                        type="text" 
                        id="name"
                        name="name" 
                        value="{{ old('name', $role->name) }}" 
                        required
                        placeholder="Masukkan nama role"
                    >
                    @error('name')
                        <div class="field-error">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                    <label for="level">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline; margin-right: 5px;">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        Level Role
                    </label>
                    <select id="level" name="level" required>
                        <option value="">Pilih Level Role</option>
                        <option value="super_super_admin" {{ old('level', $role->level) == 'super_super_admin' ? 'selected' : '' }}>Super Super Admin</option>
                        <option value="super_admin" {{ old('level', $role->level) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="admin" {{ old('level', $role->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('level', $role->level) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('level')
                        <div class="field-error">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Update Role
                    </button>
                    
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editRoleForm');
            const submitBtn = document.getElementById('submitBtn');
            const nameInput = document.getElementById('name');
            const levelSelect = document.getElementById('level');

            // Form validation
            function validateForm() {
                let isValid = true;
                
                // Clear previous validation states
                document.querySelectorAll('.form-group').forEach(group => {
                    group.classList.remove('has-error', 'has-success');
                });

                // Validate name
                if (nameInput.value.trim() === '') {
                    nameInput.closest('.form-group').classList.add('has-error');
                    isValid = false;
                } else {
                    nameInput.closest('.form-group').classList.add('has-success');
                }

                // Validate level
                if (levelSelect.value === '') {
                    levelSelect.closest('.form-group').classList.add('has-error');
                    isValid = false;
                } else {
                    levelSelect.closest('.form-group').classList.add('has-success');
                }

                return isValid;
            }

            // Real-time validation
            nameInput.addEventListener('input', function() {
                const formGroup = this.closest('.form-group');
                if (this.value.trim() !== '') {
                    formGroup.classList.remove('has-error');
                    formGroup.classList.add('has-success');
                } else {
                    formGroup.classList.remove('has-success');
                }
            });

            levelSelect.addEventListener('change', function() {
                const formGroup = this.closest('.form-group');
                if (this.value !== '') {
                    formGroup.classList.remove('has-error');
                    formGroup.classList.add('has-success');
                } else {
                    formGroup.classList.remove('has-success');
                }
            });

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }

                // Add loading state
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 11-6.219-8.56"/>
                    </svg>
                    Menyimpan...
                `;

                // Re-enable button after 10 seconds (fallback)
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Update Role
                    `;
                }, 10000);
            });

            // Auto-hide error messages after 5 seconds
            const errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.opacity = '0';
                    setTimeout(() => {
                        errorMessage.style.display = 'none';
                    }, 500);
                }, 5000);
            }

            // Add smooth focus transitions
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.form-group').style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.closest('.form-group').style.transform = 'translateY(0)';
                });
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + S to save
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    form.dispatchEvent(new Event('submit'));
                }
                
                // Escape to go back
                if (e.key === 'Escape') {
                    const backLink = document.querySelector('.btn-secondary');
                    if (backLink) {
                        window.location.href = backLink.href;
                    }
                }
            });
        });
    </script>
</body>
</html>
