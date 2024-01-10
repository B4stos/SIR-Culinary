class ReceitaCompleta {
    constructor(
        receita_id, 
        titulo, 
        modo_preparo, 
        data_preparo, 
        favorito, 
        ingredientes,
        anexos,
        descricao,
        datadescricao,
        comentarios, 
        categorias
    ) {
        this.receita_id = receita_id;
        this.titulo = titulo;
        this.modo_preparo = modo_preparo;
        this.data_preparo = data_preparo;
        this.user_id = user_id;
        this.favorito = favorito;
        this.ingredientes = ingredientes;
        this.anexos = anexos;
        this.descricao = descricao;
        this.datadescricao = datadescricao;
        this.comentarios = comentarios;
        this.categorias = categorias;
    }
}