<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Biblioteca</title>
        <link rel="stylesheet" href="css/add.css">
    </head>
    <body>
        <h1>Cadastrar Livro</h1>
        <div class="botao">
            <a href="index.php">voltar</a>
        </div>
        <div>
            <?php
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    $conexao = new mysqli('localhost', 'root', '', 'livros');
                    if(empty($_POST['nome'])){
                        echo 'Nome não informado <br/>';
                    }elseif(empty($_POST['autor'])){
                        echo 'Autor não informado <br/>';
                    }elseif(empty($_POST['editora'])){
                        echo 'Observação não informada <br/>';
                    }elseif(empty($_POST['codigo'])){
                        echo 'codigo não informado <br/>';
                    }elseif(($_POST['codigo'])==0){
                        echo 'o campo CODIGO deve ter um numero inteiro <br/>';
                    }else{
                        $query = "INSERT INTO livro
                                        (nome, autor, editora, codigo) 
                                    VALUES
                                        (
                                            '". addslashes( $_POST['nome']) ."',
                                            '". addslashes( $_POST['autor'])."',
                                            '". addslashes( $_POST['editora']) ."',
                                            '". addslashes( $_POST['codigo']) ."'
                                        );";
                        echo $query; 
                        $conexao ->query($query);
                        header('Location: index.php');
                    }
                    
                }
              
            ?>
            <form method = "post">
                Codigo: <input name="codigo" type="text">
                Nome(Livro): <input name="nome" type="text">
                Autor: <input name="autor" type="text">
                Observações: <input name="editora" type="text">
                
                <input type="submit" value="Enviar">  
            </form>
        </div>
        <div class="rodape">
            Aluno: Matheus Avelar Almeida Santana <br>
            Curso: Sitemas da informação <br>
            <img src="img/icone.png" alt="" class ="logo">
        </div>
    </body>
</html>