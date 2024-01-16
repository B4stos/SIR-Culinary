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
        categorias,
        user
    ) {
        this.receita_id = receita_id;
        this.titulo = titulo;
        this.modo_preparo = modo_preparo;
        this.data_preparo = data_preparo;
        this.favorito = favorito;
        this.ingredientes = ingredientes;
        this.anexos = anexos;
        this.descricao = descricao;
        this.datadescricao = datadescricao;
        this.comentarios = comentarios;
        this.categorias = categorias;
        this.user = user;
    }

    toJSON() {
        return {
            receita_id: this.receita_id,
            titulo: this.titulo,
            modo_preparo: this.modo_preparo,
            data_preparo: this.data_preparo,
            favorito: this.favorito,
            ingredientes: this.ingredientes,
            anexos: this.anexos,
            descricao: this.descricao,
            datadescricao: this.datadescricao,
            comentarios: this.comentarios,
            categorias: this.categorias,
            user: this.user
        };
    }
}
