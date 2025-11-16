// Funciones para mostrar y ocultar formularios
function mostrarRegistro() {
  document.getElementById('loginForm').classList.add('hidden');
  document.getElementById('registerForm').classList.remove('hidden');
}

function mostrarLogin() {
  document.getElementById('registerForm').classList.add('hidden');
  document.getElementById('loginForm').classList.remove('hidden');
}

// Mostrar mensaje flotante con animación y desaparición automática
function mostrarMensaje(texto, tipo = 'error') {
  const mensajeDiv = document.getElementById('mensaje');
  mensajeDiv.textContent = texto;
  mensajeDiv.className = 'mensaje show ' + (tipo === 'exito' ? 'mensaje-exito' : 'mensaje-error');
  
  setTimeout(() => {
    mensajeDiv.classList.remove('show');
  }, 4000);
}
