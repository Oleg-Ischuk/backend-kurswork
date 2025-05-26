<style>
/* Auth Form Styles */
.auth-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
}

.auth-card {
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
    padding: 3rem 2.5rem;
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
}

.auth-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.auth-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 0.5rem 1rem rgba(102, 126, 234, 0.3);
}

.auth-icon i {
    font-size: 2rem;
    color: white;
}

.auth-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.auth-subtitle {
    color: #718096;
    font-size: 0.95rem;
    line-height: 1.5;
}

.auth-form {
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #4a5568;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.input-group {
    position: relative;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1rem 0.875rem 3rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    font-size: 0.95rem;
    transition: all 0.2s;
    background: #f7fafc;
    color: #2d3748;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-control::placeholder {
    color: #a0aec0;
}

.input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #a0aec0;
    font-size: 1rem;
    pointer-events: none;
}

.form-control:focus + .input-icon {
    color: #667eea;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #a0aec0;
    cursor: pointer;
    padding: 0;
    font-size: 1rem;
    transition: color 0.2s;
}

.password-toggle:hover {
    color: #667eea;
}

.btn-primary {
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 0.875rem 1rem;
    border-radius: 0.75rem;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1.5rem;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.5rem 1rem rgba(102, 126, 234, 0.3);
}

.btn-primary:active {
    transform: translateY(0);
}

.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
}

.auth-footer p {
    color: #718096;
    font-size: 0.9rem;
    margin: 0;
}

.auth-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
}

.auth-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

.alert {
    padding: 0.875rem 1rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    border: 1px solid transparent;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-danger {
    background: #fed7d7;
    color: #c53030;
    border-color: #feb2b2;
}

.alert-success {
    background: #c6f6d5;
    color: #2f855a;
    border-color: #9ae6b4;
}

.form-row {
    display: flex;
    gap: 1rem;
}

.form-row .form-group {
    flex: 1;
}

.password-requirements {
    font-size: 0.8rem;
    color: #718096;
    margin-top: 0.5rem;
    padding: 0.75rem;
    background: #f7fafc;
    border-radius: 0.5rem;
    border-left: 3px solid #667eea;
}

.password-requirements strong {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    margin-bottom: 0.5rem;
    color: #4a5568;
}

.password-requirements ul {
    margin: 0;
    padding-left: 1rem;
    list-style: none;
}

.password-requirements li {
    margin-bottom: 0.25rem;
    position: relative;
    padding-left: 1rem;
}

.password-requirements li::before {
    content: "•";
    color: #667eea;
    position: absolute;
    left: 0;
}

/* Responsive Design */
@media (max-width: 576px) {
    .auth-container {
        padding: 1rem;
    }
    
    .auth-card {
        padding: 2rem 1.5rem;
        border-radius: 1rem;
    }
    
    .auth-icon {
        width: 70px;
        height: 70px;
    }
    
    .auth-icon i {
        font-size: 1.75rem;
    }
    
    .auth-title {
        font-size: 1.5rem;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="auth-title">Реєстрація</h1>
            <p class="auth-subtitle">Створіть новий акаунт для покупок у нашому магазині</p>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= url('register') ?>" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name" class="form-label">Ім'я</label>
                    <div class="input-group">
                        <input type="text" 
                               id="first_name" 
                               name="first_name" 
                               class="form-control" 
                               value="<?= htmlspecialchars($_SESSION['old_first_name'] ?? '') ?>"
                               placeholder="Введіть ваше ім'я"
                               required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="last_name" class="form-label">Прізвище</label>
                    <div class="input-group">
                        <input type="text" 
                               id="last_name" 
                               name="last_name" 
                               class="form-control" 
                               value="<?= htmlspecialchars($_SESSION['old_last_name'] ?? '') ?>"
                               placeholder="Введіть ваше прізвище"
                               required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control" 
                           value="<?= htmlspecialchars($_SESSION['old_email'] ?? '') ?>"
                           placeholder="example@email.com"
                           required>
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Пароль</label>
                <div class="input-group">
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Введіть пароль"
                           required>
                    <i class="fas fa-lock input-icon"></i>
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye" id="password-eye"></i>
                    </button>
                </div>
                <div class="password-requirements">
                    <strong>
                        <i class="fas fa-info-circle"></i>
                        Вимоги до пароля:
                    </strong>
                    <ul>
                        <li>Мінімум 6 символів</li>
                        <li>Рекомендується використовувати букви та цифри</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password" class="form-label">Підтвердження пароля</label>
                <div class="input-group">
                    <input type="password" 
                           id="confirm_password" 
                           name="confirm_password" 
                           class="form-control" 
                           placeholder="Повторіть пароль"
                           required>
                    <i class="fas fa-lock input-icon"></i>
                    <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                        <i class="fas fa-eye" id="confirm_password-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-primary">
                <i class="fas fa-user-plus"></i>
                Зареєструватися
            </button>
        </form>

        <div class="auth-footer">
            <p>Вже маєте акаунт? <a href="<?= url('login') ?>" class="auth-link">Увійти</a></p>
        </div>
    </div>
</div>

<script>
// Функція для показу/приховування пароля
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eye = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eye.classList.remove('fa-eye');
        eye.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        eye.classList.remove('fa-eye-slash');
        eye.classList.add('fa-eye');
    }
}

// Валідація паролів на клієнті
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    
    function validatePasswords() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Паролі не співпадають');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }
    
    password.addEventListener('input', validatePasswords);
    confirmPassword.addEventListener('input', validatePasswords);
});

// Очищення старих даних після завантаження
<?php 
unset($_SESSION['old_first_name'], $_SESSION['old_last_name'], $_SESSION['old_email']); 
?>
</script>