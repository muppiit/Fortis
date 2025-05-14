<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat User Baru</title>
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
            --border-radius: 10px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa, #e4ecf7);
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .create-user-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 800px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .form-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .form-header p {
            opacity: 0.8;
            font-size: 16px;
        }

        .form-header-icon {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-header-icon i {
            font-size: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .error-container {
            background-color: rgba(230, 57, 70, 0.05);
            border-left: 4px solid var(--danger);
            padding: 15px 20px;
            margin: 20px;
            border-radius: 5px;
        }

        .error-container ul {
            list-style-type: none;
        }

        .error-container ul li {
            color: var(--danger);
            font-size: 14px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .error-container ul li i {
            margin-right: 8px;
        }

        .form-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: #555;
            transition: var(--transition);
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon input,
        .input-with-icon select {
            padding-left: 45px;
        }

        .input-with-icon .icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 18px;
            transition: var(--transition);
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid #e1e5eb;
            border-radius: var(--border-radius);
            background-color: #f9fafc;
            font-size: 15px;
            color: #333;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            background-color: white;
        }

        .form-control:focus + .icon {
            color: var(--primary);
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 0;
        }

        .form-row .form-group {
            flex: 1;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            cursor: pointer;
            font-size: 16px;
            transition: var(--transition);
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .form-footer {
            padding: 20px 30px;
            background-color: #f9fafc;
            border-top: 1px solid #e1e5eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 12px 25px;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background-color: white;
            color: #666;
            border: 1px solid #e1e5eb;
        }

        .btn-secondary:hover {
            background-color: #f5f7fa;
            color: var(--primary);
        }

        .btn i {
            margin-right: 8px;
        }

        /* For select styling */
        select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23a0aec0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 15px;
        }

        /* For password strength meter */
        .password-strength {
            height: 5px;
            background-color: #e1e5eb;
            margin-top: 10px;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        .password-strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .password-strength-text {
            font-size: 12px;
            margin-top: 5px;
            color: #777;
        }

        /* Animation styles */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation: fadeInUp 0.5s ease;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-footer {
                flex-direction: column-reverse;
                gap: 15px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="create-user-container animated">
        <div class="form-header">
            <h2>Buat User Baru</h2>
            <p>Isi formulir di bawah untuk membuat pengguna baru</p>
        </div>
        
        @if ($errors->any())
            <div class="error-container animated">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.create.user') }}" method="POST" id="createUserForm">
            @csrf
            
            <div class="form-body">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nip">Nomor Induk Pegawai (NIP)</label>
                        <div class="input-with-icon">
                            <input type="text" id="nip" name="nip" class="form-control" placeholder="Masukkan NIP" value="{{ old('nip') }}" required>
                            <span class="icon"><i class="fas fa-id-card"></i></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <div class="input-with-icon">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                            <span class="icon"><i class="fas fa-user"></i></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        <span class="icon"><i class="fas fa-lock"></i></span>
                        <span class="password-toggle" id="passwordToggle"><i class="fas fa-eye"></i></span>
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-meter" id="passwordStrengthMeter"></div>
                    </div>
                    <div class="password-strength-text" id="passwordStrengthText">Kekuatan password: belum dimasukkan</div>
                </div>
                
                <div class="form-group">
                    <label for="role">Role</label>
                    <div class="input-with-icon">
                        <select name="role" id="role" class="form-control">
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <span class="icon"><i class="fas fa-user-tag"></i></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="departement">Departemen</label>
                    <div class="input-with-icon">
                        <input type="text" id="departement" name="departement" class="form-control" placeholder="Masukkan departemen" value="{{ old('departement') }}" required>
                        <span class="icon"><i class="fas fa-building"></i></span>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="team_departement">Tim Departemen</label>
                        <div class="input-with-icon">
                            <input type="text" id="team_departement" name="team_departement" class="form-control" placeholder="Masukkan tim departemen" value="{{ old('team_departement') }}" required>
                            <span class="icon"><i class="fas fa-users"></i></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="manager_departement">Manajer Departemen</label>
                        <div class="input-with-icon">
                            <input type="text" id="manager_departement" name="manager_departement" class="form-control" placeholder="Masukkan manajer departemen" value="{{ old('manager_departement') }}" required>
                            <span class="icon"><i class="fas fa-user-tie"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-footer">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> Buat User
                </button>
            </div>
        </form>
    </div>
    
    <script>
        // Toggle password visibility
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.getElementById('password');
        
        passwordToggle.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
        
        // Password strength meter
        const passwordStrengthMeter = document.getElementById('passwordStrengthMeter');
        const passwordStrengthText = document.getElementById('passwordStrengthText');
        
        passwordInput.addEventListener('input', function() {
            const value = passwordInput.value;
            let strength = 0;
            let message = '';
            
            if (value.length > 0) {
                // Length check
                if (value.length >= 8) {
                    strength += 25;
                }
                
                // Uppercase check
                if (/[A-Z]/.test(value)) {
                    strength += 25;
                }
                
                // Number check
                if (/[0-9]/.test(value)) {
                    strength += 25;
                }
                
                // Special character check
                if (/[^A-Za-z0-9]/.test(value)) {
                    strength += 25;
                }
                
                // Set message based on strength
                if (strength <= 25) {
                    message = 'Lemah';
                    passwordStrengthMeter.style.backgroundColor = '#e63946';
                } else if (strength <= 50) {
                    message = 'Sedang';
                    passwordStrengthMeter.style.backgroundColor = '#ffb703';
                } else if (strength <= 75) {
                    message = 'Kuat';
                    passwordStrengthMeter.style.backgroundColor = '#4895ef';
                } else {
                    message = 'Sangat Kuat';
                    passwordStrengthMeter.style.backgroundColor = '#52b788';
                }
            } else {
                message = 'Belum dimasukkan';
            }
            
            passwordStrengthMeter.style.width = strength + '%';
            passwordStrengthText.textContent = 'Kekuatan password: ' + message;
        });
        
        // Form validation
        const form = document.getElementById('createUserForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(e) {
            let valid = true;
            const inputs = form.querySelectorAll('input[required]');
            
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    valid = false;
                    input.style.borderColor = 'var(--danger)';
                    input.style.backgroundColor = 'rgba(230, 57, 70, 0.05)';
                } else {
                    input.style.borderColor = '#e1e5eb';
                    input.style.backgroundColor = '#f9fafc';
                }
            });
            
            if (!valid) {
                e.preventDefault();
                // Create error message if doesn't exist
                let errorContainer = document.querySelector('.error-container');
                if (!errorContainer) {
                    errorContainer = document.createElement('div');
                    errorContainer.className = 'error-container animated';
                    
                    const errorList = document.createElement('ul');
                    const errorItem = document.createElement('li');
                    errorItem.innerHTML = '<i class="fas fa-exclamation-circle"></i> Semua field harus diisi';
                    
                    errorList.appendChild(errorItem);
                    errorContainer.appendChild(errorList);
                    
                    form.parentNode.insertBefore(errorContainer, form);
                }
                
                // Scroll to top to show error
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
        
        // Custom form animations
        const formGroups = document.querySelectorAll('.form-group');
        
        formGroups.forEach((group, index) => {
            group.style.opacity = '0';
            group.style.transform = 'translateY(20px)';
            group.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            
            setTimeout(() => {
                group.style.opacity = '1';
                group.style.transform = 'translateY(0)';
            }, 100 * (index + 1));
        });
    </script>
</body>
</html>