document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('contraseña').value;

        if (!email || !password) {
            event.preventDefault(); // Evita que el formulario se envíe si algún campo está vacío
            alert('Por favor, completa todos los campos.');
        }
    });
});
