<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            transition: transform 0.3s ease;
        }
        
        .login-container:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            color: #333;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        
        .login-header .icon {
            font-size: 60px;
            color: #764ba2;
            margin-bottom: 15px;
        }
        
        .input-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .input-group label {
            display: block;
            color: #555;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 15px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.25);
            outline: none;
        }
        
        .input-group input:focus + .input-icon {
            color: #667eea;
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 40px;
            color: #999;
            transition: all 0.3s ease;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: rgba(231, 76, 60, 0.1);
            border-radius: 5px;
            text-align: center;
            display: none;
        }
        
        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .login-btn:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 40px;
            color: #999;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <h2>LOGIN ADMIN</h2>
            <p>Silakan masuk untuk mengakses panel admin</p>
        </div>
        
        <div class="error-message" id="errorMessage">
            <!-- Error message will be displayed here -->
        </div>
        
        <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
            @csrf
            <div class="input-group">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" required autocomplete="off">
                <div class="input-icon">
                    <i class="fas fa-id-card"></i>
                </div>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="password-toggle" id="passwordToggle">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            
            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
    </div>
    
    <script>
        // Show error message if exists
        document.addEventListener('DOMContentLoaded', function() {
            // Check if there's an error from Laravel
            const errorMessage = '@if ($errors->has("login_error")){{ $errors->first("login_error") }}@endif';
            
            if (errorMessage.trim() !== '') {
                const errorDiv = document.getElementById('errorMessage');
                errorDiv.textContent = errorMessage;
                errorDiv.style.display = 'block';
                document.querySelector('.login-container').classList.add('shake');
                
                setTimeout(() => {
                    document.querySelector('.login-container').classList.remove('shake');
                }, 500);
            }
        });
        
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
        
        // Form validation and animation
        const loginForm = document.getElementById('loginForm');
        
        loginForm.addEventListener('submit', function(e) {
            const nip = document.getElementById('nip').value;
            const password = document.getElementById('password').value;
            
            if (nip.trim() === '' || password.trim() === '') {
                e.preventDefault();
                
                const errorDiv = document.getElementById('errorMessage');
                errorDiv.textContent = 'NIP dan Password tidak boleh kosong!';
                errorDiv.style.display = 'block';
                
                document.querySelector('.login-container').classList.add('shake');
                
                setTimeout(() => {
                    document.querySelector('.login-container').classList.remove('shake');
                }, 500);
            }
        });
        
        // Focus effect for input fields
        const inputs = document.querySelectorAll('input');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('label').style.color = '#667eea';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('label').style.color = '#555';
            });
        });
    </script>
</body>
</html>