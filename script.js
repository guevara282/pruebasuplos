
  // Escuchar el clic en el boton "Acceder"
  document.getElementById('accederBtn').addEventListener('click', function () {
        // Ocultar el boton "Acceder"
        this.style.display = 'none';
        // Mostrar los botones ocultos
        document.getElementById('botonesOcultos').style.display = 'block';
    });
