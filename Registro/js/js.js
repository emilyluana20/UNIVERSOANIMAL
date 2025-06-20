function mostrarRegistro() {
  document.getElementById("loginForm").classList.add("hidden");
  document.getElementById("registerForm").classList.remove("hidden");
}

function mostrarLogin() {
  document.getElementById("registerForm").classList.add("hidden");
  document.getElementById("loginForm").classList.remove("hidden");
}

// Opcional: mostrar mensaje según URL
window.onload = function () {
  const params = new URLSearchParams(window.location.search);
  const msg = params.get('msg');

  if (msg === 'registro_exitoso') {
    mostrarLogin();
    mostrarMensaje("🎉 Registro exitoso. Iniciá sesión.", "exito");
  } else if (msg === 'usuario_existente') {
    mostrarRegistro();
    mostrarMensaje("⚠️ Ese correo ya está registrado.", "error");
  } else if (msg === 'contrasena_incorrecta') {
    mostrarLogin();
    mostrarMensaje("❌ Contraseña incorrecta.", "error");
  } else if (msg === 'login_exitoso') {
    mostrarMensaje("✅ Sesión iniciada correctamente.", "exito");
  }
};

function mostrarMensaje(texto, tipo = "exito") {
  const div = document.getElementById("mensaje");
  div.textContent = texto;
  div.style.backgroundColor = tipo === "error" ? "#f44336" : "#4caf50";
  div.classList.add("show");
  setTimeout(() => {
    div.classList.remove("show");
  }, 3000);
}
