$(document).ready(function() {
    $(".testJs").on("click", function() {
        var nomeCategoria = $(this).data("id");
        $("#searchInput").val("");
        $("#masonry-container").attr("data-id", nomeCategoria);
        $("#masonry-container").attr("data-pesquisa","");
        atualizarReceitas();
    });

    $("#searchForm").on("submit", function(event) {
        event.preventDefault();
        $("#masonry-container").attr("data-pesquisa", $("#searchInput").val());
        $("#masonry-container").attr("data-id","");
        atualizarReceitas();
    });
});