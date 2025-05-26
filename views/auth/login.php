<style>
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 0;
}

.login-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
    border: none;
    overflow: hidden;
}

.login-card-body {
    padding: 2.5rem;
}

.login-header {
    text-align: center;
    margin-bottom: 2rem;
}

.login-icon {
    font-size: 4rem;
    color: #667eea;
    margin-bottom: 1rem;
}

.login-title {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.login-subtitle {
    color: #718096;
    font-size: 0.95rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.input-group {
    position: relative;
}

.input-group-text {
    background-color: #f7fafc;
    border: 1px solid #e2e8f0;
    border-right: none;
    color: #718096;
    padding: 0.75rem 1rem;
}

.form-control {
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.2s;
}

.input-group .form-control {
    border-left: none;
    border-radius: 0 0.5rem 0.5rem 0;
}

.input-group .input-group-text {
    border-radius: 0.5rem 0 0 0.5rem;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

.password-toggle {
    background: transparent;
    border: 1px solid #e2e8f0;
    border-left: none;
    border-radius: 0 0.5rem 0.5rem 0;
    color: #718096;
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: all 0.2s;
}

.password-toggle:hover {
    background-color: #f7fafc;
    color: #4a5568;
}

.form-check {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.form-check-input {
    width: 1.2rem;
    height: 1.2rem;
    margin-right: 0.75rem;
    border: 2px solid #e2e8f0;
    border-radius: 0.25rem;
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.form-check-label {
    color: #4a5568;
    font-size: 0.95rem;
    cursor: pointer;
}

.login-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 0.5rem;
    color: white;
    font-weight: 600;
    padding: 0.875rem 1.5rem;
    width: 100%;
    font-size: 1rem;
    transition: all 0.2s;
    margin-bottom: 1.5rem;
}

.login-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.5rem 1rem rgba(102, 126, 234, 0.3);
}

.login-btn:active {
    transform: translateY(0);
}

.login-footer {
    text-align: center;
    color: #718096;
    font-size: 0.95rem;
}

.register-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s;
}

.register-link:hover {
    color: #5a67d8;
    text-decoration: underline;
}

.alert {
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: none;
}

.alert-danger {
    background-color: #fed7d7;
    color: #c53030;
}

.alert-success {
    background-color: #c6f6d5;
    color: #2f855a;
}

@media (max-width: 768px) {
    .login-card-body {
        padding: 2rem 1.5rem;
    }
    
    .login-icon {
        font-size: 3rem;
    }
}
</style>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-card">
                    <div class="login-card-body">
                        <div class="login-header">
                            <i class="fas fa-user-circle login-icon"></i>
                            <h3 class="login-title">Вхід до системи</h3>
                            <p class="login-subtitle">Введіть свої дані для входу</p>
                        </div>

                        <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['error']) ?>
                        </div>
                        <?php unset($_SESSION['error']); endif; ?>

                        <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['success']) ?>
                        </div>
                        <?php unset($_SESSION['success']); endif; ?>

                        <form method="POST" action="<?= url('login') ?>">
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= htmlspecialchars($_SESSION['old_email'] ?? '') ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Пароль</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="password-toggle" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Запам'ятати мене
                                </label>
                            </div>

                            <button type="submit" class="login-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>Увійти
                            </button>
                        </form>

                        <div class="login-footer">
                            <p class="mb-0">Немає акаунту? 
                                <a href="<?= url('register') ?>" class="register-link">Зареєструватися</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

// Clear old input data
<?php unset($_SESSION['old_email']); ?>
</script>