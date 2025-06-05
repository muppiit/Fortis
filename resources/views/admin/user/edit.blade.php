<div class="create-user-container">
    <div class="form-header">
        <div class="header-content">
            <div class="icon-container">
                <i class="fas fa-user-edit"></i>
            </div>
            <div class="header-text">
                <h2>Edit User</h2>
                <p>Perbarui informasi pengguna dengan mudah</p>
            </div>
        </div>
        <div class="header-decoration"></div>
    </div>

    @if ($errors->any())
        <div class="error-container">
            <div class="error-header">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Terdapat kesalahan pada form</span>
            </div>
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>
                        <i class="fas fa-times-circle"></i> 
                        <span>{{ $error }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.update-user', $user->nip) }}" method="POST" class="enhanced-form">
        @csrf
        @method('PUT')

        <div class="form-body">
            <!-- Personal Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-user"></i>
                    <h3>Informasi Personal</h3>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nip" class="form-label">
                            <i class="fas fa-id-card"></i>
                            NIP
                        </label>
                        <div class="input-container">
                            <input type="text" name="nip" id="nip" class="form-control"
                                value="{{ old('nip', $user->nip) }}" required>
                            <div class="input-underline"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-label">
                            <i class="fas fa-user-tag"></i>
                            Nama Lengkap
                        </label>
                        <div class="input-container">
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ old('nama', $user->name) }}" required>
                            <div class="input-underline"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        Password
                        <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small>
                    </label>
                    <div class="input-container password-container">
                        <input type="password" name="password" id="password" class="form-control">
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                        <div class="input-underline"></div>
                    </div>
                </div>
            </div>

            <!-- Role & Department Section -->
            <div class="form-section">
                <div class="section-header">
                    <i class="fas fa-briefcase"></i>
                    <h3>Role & Departemen</h3>
                </div>

                <div class="form-group">
                    <label for="role_id" class="form-label">
                        <i class="fas fa-user-shield"></i>
                        Role
                    </label>
                    <div class="select-container">
                        <select name="role_id" id="role_id" class="form-control select-enhanced" required>
                            @php
                                $currentLevel = auth()->user()->role->level;
                            @endphp
                            @foreach ($roles as $role)
                                @if (
                                    $currentLevel === 'super_super_admin' ||
                                        ($currentLevel === 'super_admin' && in_array($role->level, ['admin', 'user'])) ||
                                        ($currentLevel === 'admin' && $role->level === 'user'))
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $role->level)) }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                @if ($currentLevel === 'super_super_admin')
                    <div class="form-group">
                        <label for="department_id" class="form-label">
                            <i class="fas fa-building"></i>
                            Departemen
                        </label>
                        <div class="select-container">
                            <select name="department_id" id="department_id" class="form-control select-enhanced" required>
                                <option value="">Pilih Departemen</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}"
                                        {{ old('department_id', $user->teamDepartment->department_id ?? '') == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->department }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="department_id" value="{{ $user->teamDepartment->department_id }}">
                    <div class="form-group">
                        <label for="department_display" class="form-label">
                            <i class="fas fa-building"></i>
                            Departemen
                        </label>
                        <div class="input-container disabled-container">
                            <input type="text" class="form-control disabled-input" 
                                value="{{ $user->teamDepartment->department->department }}" disabled>
                            <i class="fas fa-lock disabled-icon"></i>
                        </div>
                    </div>
                @endif

                @if ($currentLevel === 'super_super_admin')
                    <div class="form-group">
                        <label for="team_department_id" class="form-label">
                            <i class="fas fa-users"></i>
                            Team Departemen
                        </label>
                        <div class="select-container">
                            <select name="team_department_id" id="team_department_id" class="form-control select-enhanced" required>
                                <option value="">Pilih Team Departemen</option>
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>
                @elseif ($currentLevel === 'super_admin')
                    <div class="form-group">
                        <label for="team_department_id" class="form-label">
                            <i class="fas fa-users"></i>
                            Team Departemen
                        </label>
                        <div class="select-container">
                            <select name="team_department_id" id="team_department_id" class="form-control select-enhanced" required>
                                <option value="">Pilih Team Departemen</option>
                                @foreach ($teamDepartments as $team)
                                    @if ($team->department_id == auth()->user()->teamDepartment->department_id)
                                        <option value="{{ $team->id }}"
                                            {{ old('team_department_id', $user->team_department_id) == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down select-arrow"></i>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="team_department_id" value="{{ $user->team_department_id }}">
                    <div class="form-group">
                        <label for="team_department_display" class="form-label">
                            <i class="fas fa-users"></i>
                            Team Departemen
                        </label>
                        <div class="input-container disabled-container">
                            <input type="text" class="form-control disabled-input"
                                value="{{ $user->teamDepartment->name }}" disabled>
                            <i class="fas fa-lock disabled-icon"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-footer">
            <div class="button-group">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </div>
    </form>

    @if ($currentLevel === 'super_super_admin')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const departmentSelect = document.getElementById('department_id');
                const teamSelect = document.getElementById('team_department_id');
                
                const allTeams = @json($teamDepartments);

                function populateTeams(departmentId, selectedTeamId = null) {
                    teamSelect.innerHTML = '<option value="">Pilih Team Departemen</option>';
                    
                    // Add loading animation
                    teamSelect.parentElement.classList.add('loading');
                    
                    setTimeout(() => {
                        allTeams.forEach(team => {
                            if (team.department_id == departmentId) {
                                const option = document.createElement('option');
                                option.value = team.id;
                                option.text = team.name;

                                if (selectedTeamId && selectedTeamId == team.id) {
                                    option.selected = true;
                                }

                                teamSelect.appendChild(option);
                            }
                        });
                        
                        teamSelect.parentElement.classList.remove('loading');
                        teamSelect.parentElement.classList.add('loaded');
                        
                        setTimeout(() => {
                            teamSelect.parentElement.classList.remove('loaded');
                        }, 300);
                    }, 300);
                }

                if (departmentSelect.value) {
                    populateTeams(departmentSelect.value, '{{ old('team_department_id', $user->team_department_id) }}');
                }

                departmentSelect.addEventListener('change', function() {
                    populateTeams(this.value);
                });
            });

            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }

            // Enhanced form interactions
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                    if (this.value.trim() !== '') {
                        this.parentElement.classList.add('has-value');
                    } else {
                        this.parentElement.classList.remove('has-value');
                    }
                });
                
                // Check initial values
                if (input.value.trim() !== '') {
                    input.parentElement.classList.add('has-value');
                }
            });
        </script>
    @endif

    <style>
        .create-user-container {
            max-width: 800px;
            margin: 2rem auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            position: relative;
        }

        .create-user-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7);
            background-size: 300% 100%;
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .form-header {
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            backdrop-filter: blur(10px);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            z-index: 2;
        }

        .icon-container {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .icon-container i {
            font-size: 1.5rem;
            color: white;
        }

        .header-text h2 {
            margin: 0;
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .header-text p {
            margin: 0.5rem 0 0 0;
            color: rgba(255,255,255,0.8);
            font-size: 0.95rem;
        }

        .header-decoration {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .enhanced-form {
            background: white;
            padding: 0;
        }

        .form-body {
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
            background: #f8f9ff;
            border-radius: 15px;
            padding: 1.5rem;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e9ecef;
        }

        .section-header i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .section-header h3 {
            margin: 0;
            color: #2c3e50;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            color: #2c3e50;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-label i {
            color: #667eea;
            font-size: 0.85rem;
        }

        .text-muted {
            color: #6c757d !important;
            font-weight: 400;
        }

        .input-container {
            position: relative;
            transition: all 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-underline {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            width: 0;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .input-container.focused .input-underline {
            width: 100%;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .select-container {
            position: relative;
        }

        .select-enhanced {
            appearance: none;
            background: white;
            cursor: pointer;
        }

        .select-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .select-container.loading .select-arrow {
            animation: spin 1s linear infinite;
        }

        .select-container.loaded .select-arrow {
            color: #28a745;
        }

        @keyframes spin {
            0% { transform: translateY(-50%) rotate(0deg); }
            100% { transform: translateY(-50%) rotate(360deg); }
        }

        .disabled-container {
            position: relative;
        }

        .disabled-input {
            background: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }

        .disabled-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 0.8rem;
        }

        .error-container {
            margin: 1.5rem 2rem;
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            border-radius: 10px;
            padding: 1rem;
            color: white;
            animation: slideInDown 0.5s ease;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .error-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-list li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0;
        }

        .form-footer {
            background: #f8f9fa;
            padding: 1.5rem 2rem;
            border-top: 1px solid #e9ecef;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        @media (max-width: 576px) {
            .button-group {
                flex-direction: column;
            }
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            background: #5a6268;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .create-user-container {
                margin: 1rem;
                border-radius: 15px;
            }
            
            .form-header {
                padding: 1.5rem;
            }
            
            .header-content {
                flex-direction: column;
                text-align: center;
            }
            
            .form-body {
                padding: 1.5rem;
            }
            
            .form-section {
                padding: 1rem;
            }
        }

        /* Animation for form load */
        .create-user-container {
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</div>