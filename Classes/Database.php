<?php

namespace Classes;

require_once (__DIR__."/ReceitaCard.php");
require_once (__DIR__."/Categoria.php");
require_once (__DIR__."/../Config/ConfigDB.php");
use Classes\ReceitaCard;
use Classes\Categoria;
use Config\ConfigDB;
use PDO;
use PDOException;



class Database {
    
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $configDB;

    public function __construct() {
        $this->configDB = new ConfigDB();
        $this->servername = $this->configDB->server;
        $this->username = $this->configDB->username;
        $this->password = $this->configDB->password;
        $this->dbname = $this->configDB->database;
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            #echo "Conexão com o banco de dados estabelecida com sucesso";
        } catch(PDOException $e) {
            #echo "Conexão falhou: " . $e->getMessage();
        }
    }

    public function updatePasswordHashes() {
        $query = "SELECT user_id, password FROM Users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $utilizadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($utilizadores as $utilizador) {
            $novoHash = password_hash($utilizador['password'], PASSWORD_DEFAULT);

            $updateQuery = "UPDATE Users SET password = :novoHash WHERE user_id = :userId";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(":novoHash", $novoHash);
            $updateStmt->bindParam(":userId", $utilizador['user_id']);
            $updateStmt->execute();
        }

        echo "Hashes de senha atualizados com sucesso!";
    }

    public function getAllRecipes() {
        $query = "SELECT * FROM Receitas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $receitasData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $receitas = [];

        foreach ($receitasData as $receitaData) {
            $receitas[] = new Receita(
                $receitaData['receita_id'],
                $receitaData['titulo'],
                $receitaData['modo_preparo'],
                $receitaData['data_preparo'],
                $receitaData['user_id']
            );
        }

        return $receitas;
    }

    public function getAllAnexos() {
        $query = "SELECT * FROM Anexos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $anexosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $anexos = [];
    
        foreach ($anexosData as $anexoData) {
            $anexos[] = new Anexo(
                $anexoData['anexo_id'],
                $anexoData['tipo'],
                $anexoData['ficheiro'],
                $anexoData['descricao'],
                $anexoData['receita_id'],
                $anexoData['user_id']
            );
        }
    
        return $anexos;
    }

    public function getAllComentarios() {
        $query = "SELECT * FROM Comentario";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $comentariosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $comentarios = [];
    
        foreach ($comentariosData as $comentarioData) {
            $comentarios[] = new Comentario(
                $comentarioData['comentario_id'],
                $comentarioData['receita_id'],
                $comentarioData['user_id'],
                $comentarioData['data'],
                $comentarioData['text'],
                $comentarioData['validacao']
            );
        }
    
        return $comentarios;
    }

    public function getAllIngredientes() {
        $query = "SELECT * FROM Ingredientes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $ingredientesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $ingredientes = [];
    
        foreach ($ingredientesData as $ingredienteData) {
            $ingredientes[] = new Ingrediente(
                $ingredienteData['ingrediente_id'],
                $ingredienteData['nome'],
                $ingredienteData['tipo_ingrediente'],
                $ingredienteData['localizacao'],
                $ingredienteData['valor']
            );
        }
    
        return $ingredientes;
    }

    public function getAllCategorias() {
        $query = "SELECT * FROM Categorias";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categoriasData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $categorias = [];
    
        foreach ($categoriasData as $categoriaData) {
            $categorias[] = new Categoria(
                $categoriaData['categoria_id'],
                $categoriaData['nome']
            );
        }
    
        return $categorias;
    }

    public function getReceitasCards() {
        try {
            $stmt = $this->conn->query("SELECT * FROM receitacard");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $receitas = array();

            foreach ($result as $row) {
                $receita = new ReceitaCard(
                    $row['id_receita'],
                    $row['titulo_receita'],
                    $row['data_preparo'],
                    $row['imagem_anexo'],
                    $row['nome_categoria'],
                    $row['user_id'],
                    $row['first_name'],
                    $row['imagem_usuario']
                );

                $receita->setDefaultImagemAnexo();
                $receita->setDefaultImagemUsuario();
                $receita->setData($receita->formatarData($row['data_preparo']));
                $receitas[] = $receita;

            }
            return $receitas;
            
        } catch(PDOException $e) {
            echo "Erro buscar a vista " . $e->getMessage();
        }

    }

    public function getReceitaCardCategoria($nomeCategoria) {
        try {
            $query = "SELECT * FROM receitacard WHERE nome_categoria = :nomeCategoria";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nomeCategoria', $nomeCategoria, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $receitas = array();
    
            foreach ($result as $row) {
                $receita = new ReceitaCard(
                    $row['id_receita'],
                    $row['titulo_receita'],
                    $row['data_preparo'],
                    $row['imagem_anexo'],
                    $row['nome_categoria'],
                    $row['user_id'],
                    $row['first_name'],
                    $row['imagem_usuario']
                );
    
                $receita->setDefaultImagemAnexo();
                $receita->setDefaultImagemUsuario();
                $receita->setData($receita->formatarData($row['data_preparo']));
                $receitas[] = $receita;
            }
    
            return $receitas;
        } catch(PDOException $e) {
            echo "Erro ao buscar receitas por categoria: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>