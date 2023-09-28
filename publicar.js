$(document).ready(function() {
    // oir click en el boton "Publicar"
    $(".publicar-oferta").click(function(e) {
        e.preventDefault();
        var ofertaId = $(this).data("id");

        // Envia una solicitud AJAX al servidor para actualizar el campo
        $.ajax({
            url: "actualizarestado.php", // Url donde se manda el id
            method: "POST",
            data: { id: ofertaId },
            success: function(response) {
             
                alert("Oferta publicada con éxito");
              
            },
            error: function() {
          
                alert("Error al publicar la oferta");
            }
        });
    });
});