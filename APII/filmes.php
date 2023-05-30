<?php
//Livros.php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//GET recebe/pega informaçõe
//POST envia informações
//PUT edita informações "update"
//DELETE deleta informações
//OPTIONS  é a  relação de methodos disponiveis para uso
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}
//  else {
//     echo "erro de requisição";
// }

include 'conexao.php';

//Rota para obter TODOS os livros
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //aqui eu crio o comando de select para consultar o banco
    $stmt = $conn->prepare("SELECT * FROM filmes");
    //aqui eu executo o select
    $stmt->execute();
    //aqui eu recebo os dados do banco por meio do PDO
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //transformo os dados da variave $livros em um JSON valido
    echo json_encode($filmes);
}

//Rota para criar livros
//Rota para inserir livros
//Utilizando o POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $autor = $_POST['autor'];
    $ano_lancamento = $_POST['ano_lancamento'];
    $genero = $_POST['genero'];
    //inserir outros campos caso necessario ....

    $stmt = $conn->prepare("INSERT INTO filmes (titulo, diretor, autor, ano_lancamento, genero) VALUES (:titulo, :diretor, :autor, :ano_lancamento, :genero)");
    $stmt -> bindParam(':titulo', $titulo);
    $stmt -> bindParam(':diretor', $diretor);
    $stmt -> bindParam(':autor', $autor);
    $stmt -> bindParam(':ano_lancamento', $ano_lancamento);
    $stmt -> bindParam(':genero', $genero);
    //Outros bindParams ....

    if($stmt->execute()){
        echo "Filme criado com sucesso!!";
    }else{
        echo "Erro ao criar Filme";
    }
}


//rota para excluir um livro
if($_SERVER['REQUEST_METHOD']==='DELETE' && isset($_GET['id'])){
    $id   = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM filmes WHERE id = :id");
    $stmt-> bindParam(':id', $id);

    if($stmt->execute()){
        echo "Filme excluido com sucesso!!!";
    } else {
        echo "Erro ao excluir Filme!";
    }
}

//rota para atualizar um livro existente
if($_SERVER['REQUEST_METHOD']==='PUT' && isset($_GET['id'])){
    parse_str(file_get_contents("php://input"), $_PUT);

    $id  = $_GET['id'];
    $novoTitulo = $_PUT['titulo'];
    $novoDiretor = $_PUT['diretor'];
    $novoAutor  = $_PUT['autor'];
    $novoAno    = $_PUT['ano_lancamento'];
    $novoGenero  = $_PUT['genero'];

    $stmt = $conn->prepare("UPDATE livros SET titulo = :titulo, autor = :autor, ano_publicacao = :ano_publicacao WHERE id= :id");
    $stmt->bindParam(':titulo', $novoTitulo);
    $stmt->bindParam(':diretor', $novoDiretor);
    $stmt->bindParam(':autor', $novoAutor);
    $stmt->bindParam(':ano_lancamento', $novoAno);
    $stmt->bindParam(':genero', $novoGenero);
    $stmt->bindParam(':id', $id);
    //add novos campos caso necessario

    if($stmt->execute()){
        echo "Livro atualizado !!";
    }else{
        echo "Erro ao atualizar livro!!";
    }
}