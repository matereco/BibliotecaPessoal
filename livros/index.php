<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Biblioteca</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!-- 
        * <instituição: União Metropolitana de Educação e Cultura(UNIME), Lauro de Freitas>
        * <curso: Bacharelado em sistemas da informação>
        * <disciplina: programação web II>
        * <Professor: Pablo Ricardo Roxo Silva>
        * <Aluno: Matheus Avelar Almeida Santana>
        -->


        <!-- editora virou observações -->
        <?php

        //busca
        $busca = filter_input(INPUT_GET, 'k', FILTER_SANITIZE_STRING);

        //condições sql
        $condicoes = [
            strlen($busca) ? 'nome LIKE "%'.$busca.'%"' : null
        ];

        //$where = implode(' AND ', $condicoes);
        
        
        ?>
        
        <div class="cadastro">
            <table  class="teto">
                <td>
                    <a href="add.php" class ="botao">
                        Cadastrar Livro <br>
                        <img src="img/addicon.png" alt="">
                        
                    </a>
                </td>
                <td>
                    <form action="" method = "GET">
                        <input type="text" name ="k" placeholder="Pesquise qualquer coisa" value ="<?=$busca?>"  autocomplete="off">
                        <input type="submit" value="Buscar">
                    </form>
                </td>
            </table>
            <?php


             //print_r($condicoes);


            // Checagem para ver se foi escrito algo
                // if(isset($_GET['k'])&& $_GET['k'] != ''){

                //     // Salva as palavras do url
                //     $k = trim($_GET['k']);

                //     // cria a query base e palavra string
                //     $query_string = " SELECT * FROM livro WHERE  ";

                //     // separa cada palavra chave
                //     $palavrasChave = explode(' ', $k);
                //     foreach($palavrasChave as $palavra){
                //         $query_string .= "palavarsChave LIKE '%".$palavra."%' OR ";
                        
                //     }
                //     $query_string = substr($query_string, 0, strlen($query_string) - 3);
                    

                    // conectar com o BD
                    //$conexao1 = mysqli_connect('localhost', 'root', '', 'livros');
                    //$query1 = mysqli_query($conexao1, $query_string);
                    //$busca = filter_input(INPUT_GET, 'k', FILTER_SANITIZE_STRING);
                    //$qntResultado = mysqli_num_rows($query1);

                    // checagem para ver se retorna resultado
                    // if($qntResultado > 0){
                    //     echo '<table class="search>';
                    //     while($b = mysqli_fetch_assoc($query1)){
                    //      echo '<tr>
                    //      <td>a</td>
                    //      <td>a</td>
                    //      <td>a</td>
                    //     </tr>';
                    //     }
                    //     echo '</table>';
                    // }else 
                    // echo 'Nenhum resultado encontrado. Tente outro nome/numero ';

                   

                // }else
                //     echo '';
            
            ?>
        </div>
        
        <div class="content">
        
        <h1>Biblioteca Pessoal</h1>
            <table border = "1" class="tabela">
                <tr>
                    
                    <th style="width:7%">CODIGO</th>
                    <th style="width:30%">TÍTULO</th>
                    <th style="width:20%">AUTOR</th>
                    <th style="width:15%">OBSERVAÇÕES</th>
                    <th style="width: 7%">OPÇÕES</th>
                </tr>
            
                <?php
                
                    $conexao = new mysqli('localhost', 'root', '', 'livros');

                    if(!empty($_GET['id'])){
                        /* echo 'apagando pessoa do id= ' . $_GET['id']; */
                        $query = "DELETE FROM livro WHERE id = " . $_GET['id'] . ";";
                        $conexao->query($query);
                    }

                    if($busca == null){
                        $query = ("SELECT * FROM livro");
                        $lista = $conexao->query($query);
                    }else{
                        $query = ("SELECT * FROM livro WHERE nome LIKE '%$busca%' OR autor LIKE '%$busca%'OR gênero LIKE '%$busca%'OR editora LIKE '%$busca%'OR codigo LIKE '%$busca%' ORDER BY nome");
                        $lista = $conexao->query($query);
                    }

                    while($a = $lista->fetch_assoc()){
                    echo' 
                            <tr>
                                
                                <td>' . $a['codigo']  .'</td>
                                <td>' . $a['nome'] . '</td>
                                <td>' . $a['autor'] . '</td>
                                <td>' . $a['editora'] . '</td>
                                
                                <td>
                                    <a class="editar" href="edit.php?id='. $a['id'] . '"><img border="0" alt="edit" src="img/edit-icon.png"/></a>
                                    <a class="excluir" href="#" onclick="excluir('. $a['id'] . ')"> <img border="0" alt="edit" src="img/icondelete.png"/></a>
                                </td>
                            </tr>
                        ';
                    }
                //add observações
                // codigo/ nome / autor / observações

                ?>
            </table>
        </div>
        <div class="rodape">
            Aluno: Matheus Avelar Almeida Santana <br>
            Curso: Sitemas da informação <br>
            <img src="img/icone.png" alt="" class ="logo">
        </div>
        <script type="text/javascript">
            function excluir(id) {
                if(confirm("Quer mesmo apagar o livro?")){
                    window.location = '?id=' + id;
                }
                
            }
        </script>
        
    </body>
</html>