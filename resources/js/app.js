// import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        console.log("tes123");
        // Ganti gambar mata tergantung pada tipe input
        if (type === 'password') {
            eyeIcon.src = "{{ asset('assets/icons/actionable/eye-slash.svg') }}";
        } else {
            eyeIcon.src = "{{ asset('assets/icons/actionable/eye.svg') }}";
        }
    });
});

console.log('halllo1');
