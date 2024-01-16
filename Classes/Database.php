<?php

namespace Classes;

require_once (__DIR__."/ReceitaCard.php");
require_once (__DIR__."/Categoria.php");
require_once (__DIR__."/Ingrediente.php");
require_once (__DIR__."/Comentario.php");
require_once (__DIR__."/Descricao.php");
require_once (__DIR__."/ReceitaCompleta.php");
require_once (__DIR__."/Anexo.php");
require_once (__DIR__."/Receita.php");
require_once (__DIR__."/Utilizador.php");
require_once (__DIR__."/../Config/ConfigDB.php");

use Classes\Utilizador;
use Classes\Ingrediente;
use Classes\Comentario;
use Classes\Descricao;
use Classes\Receita;
use Classes\ReceitaCard;
use Classes\Categoria;
use Classes\ReceitaCompleta;
use Classes\Anexo;
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

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $utilizadoresData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $utilizadores = [];
        
        foreach ($utilizadoresData as $utilizadorData) {
            $utilizadores[] = new Utilizador(
                $utilizadorData['user_id'],
                $utilizadorData['first_name'],
                $utilizadorData['last_name'],
                $utilizadorData['notificacao'],
                $utilizadorData['email'],
                $utilizadorData['imagem'],
                $utilizadorData['telefone']
            );
        }

        return $utilizadores;
    }

    public function updateUserInfo($user_id, $first_name, $last_name, $email, $telefone) {
        $query = "UPDATE users SET first_name = ?, last_name = ?, email = ?, telefone = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$first_name, $last_name, $email, $telefone, $user_id]);
        // Add error handling if needed
    }


    /*public function updateUserImage($user_id, $imagePath) {
        $query = "UPDATE users SET imagem = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$imagePath, $user_id]);
        // Add error handling if needed
    }*/


    public function updateUserImage($user_id, $imagePath) {
        $query = "UPDATE users SET imagem = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        
        // Construct the relative path from the absolute path
        $relativeImagePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $imagePath);
        
        $stmt->execute([$relativeImagePath, $user_id]);
        // Add error handling if needed
    }


    public function getImagem($user_id) {
        $query = "SELECT imagem FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$userData || empty($userData['imagem'])) {
            // Provide a default image URL or handle the case where the file doesn't exist
            return 'imgsupload/default-image.png';
        }
    
        return $userData['imagem'];
    }
    
    


    public function getUserById($user_id) {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$userData) {
            return null; // User not found
        }
    
        return new Utilizador(
            $userData['user_id'],
            $userData['first_name'],
            $userData['last_name'],
            $userData['notificacao'],
            $userData['email'],
            $userData['imagem'],
            $userData['telefone']
        );
    }


    public function isEmailTaken($email) {
        $query = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }


    public function isTelefoneTaken($telefone) {
        $query = "SELECT COUNT(*) FROM users WHERE telefone = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$telefone]);
        return $stmt->fetchColumn() > 0;
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

    public function getReceitaPorId($receitaId) {
        $query = "SELECT * FROM Receitas WHERE receita_id = :receitaId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':receitaId', $receitaId, PDO::PARAM_INT);
        $stmt->execute();
    
        $receitaData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($receitaData) {
            $receita = new Receita(
                $receitaData['receita_id'],
                $receitaData['titulo'],
                $receitaData['modo_preparo'],
                $receitaData['data_preparo'],
                $receitaData['user_id']
            );
    
            return $receita;
        }
    
        return null; // Retorna null se não encontrar a receita
    }

    public function getAnexosPorReceitaId($receitaId) {
        $query = "SELECT * FROM Anexos WHERE receita_id = :receitaId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':receitaId', $receitaId, PDO::PARAM_INT);
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

    public function getComentariosPorReceitaId($receitaId) {
        $query = "SELECT * FROM Comentarios WHERE receita_id = :receitaId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':receitaId', $receitaId, PDO::PARAM_INT);
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

    public function getIngredientesPorReceitaId($receitaId) {
        $query = "SELECT * FROM Ingredientes WHERE receita_id = :receitaId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':receitaId', $receitaId, PDO::PARAM_INT);
        $stmt->execute();
        $ingredientesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $ingredientes = [];
    
        foreach ($ingredientesData as $ingredienteData) {
            $ingredientes[] = new Ingrediente(
                $ingredienteData['ingrediente_id'],
                $ingredienteData['nome'],
                $ingredienteData['quantidade_na_receita'],
                $ingredienteData['localizacao'],
                $ingredienteData['valor']
            );
        }
    
        return $ingredientes;
    }

    public function getCategoriasPorReceitaId($receitaId) {
        $query = "SELECT C.* FROM Categorias C
                  JOIN Receitas_Categorias RC ON C.categoria_id = RC.categoria_id
                  WHERE RC.receita_id = :receitaId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':receitaId', $receitaId, PDO::PARAM_INT);
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

    public function getDescricaoPorId($receitaId) {
        $query = "SELECT * FROM Descricoes WHERE receita_id = :receitaId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':receitaId', $receitaId, PDO::PARAM_INT);
        $stmt->execute();
        $descricaoData = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($descricaoData) {
            $descricao = new Descricao(
                $descricaoData['descricao_id'],
                $descricaoData['descricao'],
                $descricaoData['data'],
                $descricaoData['receita_id']
            );
    
            return $descricao;
        }
    
        return null;
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

    public function getReceitaCardtitulo($titulo) {
        try {
            $query = "SELECT * FROM receitacard WHERE titulo_receita = :titulo";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
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

    public function adicionarReceita(ReceitaCompleta $receita) {
        session_start();
        $receita->setDataPreparoAtual();
        $receita->anexos->verificartipoficheiro();
        $utilizador = isset($_SESSION['utilizador']) ? $_SESSION['utilizador'] : null;
        $userId = $utilizador->getUserId();

    
        try {
            $this->connect();
    
            $titulo = $receita->getTitulo();
            $modoPreparo = $receita->getModoPreparo();
            $dataPreparo = $receita->getDataPreparo();
            $notas = $receita->getDescricao();
            $ingredientes = $receita->getIngredientes();
            $categorianome = $receita->categorias->getNome();
    
            $utilizador = $_SESSION['utilizador'];
            $userId = $utilizador->getUserId();
    
            // Inserir a receita principal
            $stmtReceita = $this->conn->prepare("INSERT INTO Receitas (titulo, modo_preparo, data_preparo, user_id) VALUES (?, ?, ?, ?)");
            $resultReceita = $stmtReceita->execute([$titulo, $modoPreparo, $dataPreparo, $userId]);
    
            if (!$resultReceita) {
                throw new PDOException("Erro ao inserir na tabela Receitas.");
            }
    
            // Obter o ID da última receita inserida
            $receitaId = $this->conn->lastInsertId();
    
            // Inserir os ingredientes associados a essa receita
            $stmtIngrediente = $this->conn->prepare("INSERT INTO Ingredientes (nome, quantidade_na_receita, localizacao, valor, receita_id) VALUES (?, ?, ?, ?, ?)");
            foreach ($ingredientes as $ingrediente) {
                $ingredienteNome = $ingrediente->getNome();
                $ingredienteQuantidade = $ingrediente->getQuantidade();
                $ingredienteOrigem = $ingrediente->getOrigem();
                $ingredienteValor = $ingrediente->getValor();
    
                $resultIngrediente = $stmtIngrediente->execute([$ingredienteNome, $ingredienteQuantidade, $ingredienteOrigem, $ingredienteValor, $receitaId]);
    
                if (!$resultIngrediente) {
                    throw new PDOException("Erro ao inserir na tabela Ingredientes.");
                }
            }
    
            $stmtAnexo = $this->conn->prepare("INSERT INTO Anexos (tipo,ficheiro,receita_id, user_id) VALUES (?,?, ?, ?)");
            $anexo = $receita->getAnexos();  
            $anexoFicheiro = $anexo->getFicheiro();
            $anexoTipo = $anexo->getTipo();

            $anexoFicheiro = !empty($anexoFicheiro) ? $anexoFicheiro : null;

            $resultAnexo = $stmtAnexo->execute([$anexoTipo,$anexoFicheiro, $receitaId, $userId]);

            if (!$resultAnexo) {
                throw new PDOException("Erro ao inserir na tabela Anexos.");
            }


    
            $stmtCategoriaExistente = $this->conn->prepare("SELECT categoria_id FROM Categorias WHERE nome = ?");
            $stmtCategoriaExistente->execute([$categorianome]);
            $categoriaExistente = $stmtCategoriaExistente->fetch(PDO::FETCH_ASSOC);

            if ($categoriaExistente) {
            // Utilizar a categoria existente
            $categoriaId = $categoriaExistente['categoria_id'];
            } else {
            // Inserir a categoria apenas se não existir
            $stmtCategoria = $this->conn->prepare("INSERT INTO Categorias (nome) VALUES (?)");
            $stmtCategoria->execute([$categorianome]);

            // Obter o ID da última categoria inserida
            $categoriaId = $this->conn->lastInsertId();
             }

            // Inserir o relacionamento na tabela Receitas_Categorias
            $stmtReceitaCategoria = $this->conn->prepare("INSERT INTO Receitas_Categorias (receita_id, categoria_id) VALUES (?, ?)");
            $stmtReceitaCategoria->execute([$receitaId, $categoriaId]);

            $stmtDescricao = $this->conn->prepare("INSERT INTO Descricoes (descricao, receita_id) VALUES (?, ?)");
            $resultDescricao = $stmtDescricao->execute([$notas, $receitaId]);

            if (!$resultDescricao) {
            throw new PDOException("Erro ao inserir na tabela Descricoes.");
            }

        } catch(PDOException $e) {
            echo "Erro ao adicionar receita ao banco de dados: " . $e->getMessage();
        }
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

    public function getReceitaCompletaPorId($receitaId) {
        
        $utilizador = isset($_SESSION['utilizador']) ? $_SESSION['utilizador'] : null;
        $userId = $utilizador->getUserId();

        $receita = $this->getReceitaPorId($receitaId);
    
        if (!$receita) {
            return null; // Retorna null se a receita não for encontrada
        }
   
        $ingredientes = $this->getIngredientesPorReceitaId($receitaId);
    
        $anexos = $this->getAnexosPorReceitaId($receitaId);
    
        $comentarios = $this->getComentariosPorReceitaId($receitaId);

        $descricao = $this->getDescricaoPorId($receitaId);

        $categorias = $this->getCategoriasPorReceitaId($receitaId);
    
        $receitaCompleta = new ReceitaCompleta(
            $receita->getReceitaId(),
            $receita->getTitulo(),
            $receita->getModoPreparo(),
            $receita->getDataPreparo(),
            null,
            $ingredientes,
            $anexos,
            $descricao->getDescricao(),
            $descricao->getData(),
            $comentarios,
            $categorias,
            $userId 
        );
    
        return $receitaCompleta;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>