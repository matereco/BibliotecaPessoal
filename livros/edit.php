<!DOCTYPE html>
<html>
<!-- editora virou observações -->
    <head>
        <meta charset="UTF-8">
        <title>Biblioteca</title>
        <link rel="stylesheet" href="css/add.css">
    </head>
    <body>
        <h1>Editar Livro</h1>
        <div class="botao">
            <a href="index.php">voltar</a>
        </div>
        <div>
            <?php
                $conexao = new mysqli('localhost', 'root', '', 'livros');
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
                        $query = "UPDATE livro
                                    SET  
                                        nome ='". addslashes( $_POST['nome']) ."',
                                        autor ='". addslashes( $_POST['autor'])."',
                                        editora ='". addslashes( $_POST['editora']) ."',
                                        codigo ='". addslashes( $_POST['codigo']) ."'
                                    
                                    WHERE id = " . $_POST['id'] .  ";";
                       // echo $query; 
                        $conexao ->query($query);
                        header('Location: index.php');
                    }
                    
                }
                $query = "SELECT * FROM livro WHERE id = " . $_GET['id'] . ";";
                $livro = $conexao->query($query);
                $livro = $livro->fetch_assoc();
               /*  print_r($livro); */
            ?>
            <form method = "post">
                Codigo: <input name="codigo" type="text" value="<?= $livro['codigo']?>">
                Nome(Livro): <input name="nome" type="text" value="<?= $livro['nome']?>"/>
                Autor: <input name="autor" type="text" value="<?= $livro['autor']?>">
                Observações: <input name="editora" type="text" value="<?= $livro['editora']?>">
                
                <input type="hidden" name = "id" value = "<?= $_GET['id'] ?>"/>
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