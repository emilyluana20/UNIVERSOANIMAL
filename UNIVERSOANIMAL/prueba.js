document.addEventListener("DOMContentLoaded", () => {
  const botonMenu = document.querySelector(".menu-hamburguesa");
  const menu = document.querySelector(".menu");

  if (botonMenu && menu) {
    botonMenu.addEventListener("click", () => {
      menu.classList.toggle("active"); // ✅ CAMBIADO a 'active'
      botonMenu.classList.toggle("active"); // también para animar el ícono
    });
  }
});
