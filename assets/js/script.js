document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.createElement('div');
    overlay.className = 'loading-overlay show';
    overlay.innerHTML = '<div class="spinner"></div>';
    document.body.appendChild(overlay);

    window.setTimeout(function () {
        overlay.classList.remove('show');
        overlay.remove();
    }, 650);

    const scrollBtn = document.getElementById('scrollTopBtn');
    if (scrollBtn) {
        window.addEventListener('scroll', function () {
            scrollBtn.classList.toggle('show', window.scrollY > 300);
        });
        scrollBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('passwordField');
    if (togglePassword && passwordField) {
        togglePassword.addEventListener('click', function () {
            const isHidden = passwordField.type === 'password';
            passwordField.type = isHidden ? 'text' : 'password';
            togglePassword.innerHTML = isHidden ? '<i class="fa-solid fa-eye-slash"></i>' : '<i class="fa-solid fa-eye"></i>';
        });
    }

    const forms = document.querySelectorAll('form');
    forms.forEach(function (form) {
        form.addEventListener('submit', function () {
            const loading = document.createElement('div');
            loading.className = 'loading-overlay show';
            loading.innerHTML = '<div class="spinner"></div>';
            document.body.appendChild(loading);
            window.setTimeout(function () {
                if (loading.parentNode) {
                    loading.remove();
                }
            }, 1800);
        });
    });
});