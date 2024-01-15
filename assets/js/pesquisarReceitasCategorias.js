$(document).ready(function() {
   
    $(".testJs").on("click", function() {
        var nomeCategoria = $(this).data("id");
        $("#masonry-container").attr("data-id", nomeCategoria);
        atualizarReceitas();
    });

});
