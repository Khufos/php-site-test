<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    
    <title>Listagem de jogos</title>
</head>
<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/login.php";
        require_once "includes/funcoes.php";
        $ordem= $_GET['o'] ?? "n";
        $chave= $_GET['c'] ?? " ";
    ?>
    <div id="corpo">
        <?php include "topo.php"; ?>
        <h1>Escolha o seu jogo </h1>
        <form method="get" id="busca" action="index.php">
        Ordernar: 
        <a href="index.php?o=n&c=<?php echo $chave;?>"> Nome </a> | 
        <a href="index.php?o=p&c=<?php echo $chave;?>"> Produtora </a>| 
        <a href="index.php?o=n1&c=<?php echo $chave;?>"> Nota Alta</a>| 
        <a href="index.php?o=n2&c=<?php echo $chave;?>"> Nota baixa</a>|
        <a href="index.php"> Mostrar Todos |</a>
        Busca:<input type="text" name="c" size="10" maxlength="40"/>
        <input type="submit" value="OK"/>
        </form>
        <table class="listagem">
            <?php
                $q = "select j.cod, j.nome, g.genero, j.capa ,p.produtora from jogos j join generos g on
                j.genero = g.cod join produtoras p on j.produtora = p.cod ";
                if (!empty($chave)){
                    $q .=  "WHERE  j.nome like '%$chave%' OR p.produtora like '%$chave%' OR g.genero like '%$chave' ";
                }
                switch($ordem) {
                    case "p":
                        $q .= "ORDER BY p.produtora";
                        break;
                    case "n1":
                        $q .= "ORDER BY j.nota DESC";
                        break;
                    case 'n2':
                        $q .= "ORDER BY j.nota ASC";
                        break;
                    default:    
                        $q .= "ORDER BY j.nome";
                        break;

                }
                $busca = $banco->query($q);
                if(!$busca){
                    echo "<p> Falha no banco de dados no body da aplicação </p>";
                } else{
                    if($busca->num_rows == 0){
                        echo "<p> Nenhum registro encontrado </p>";
                    }else{
                        while($req=$busca->fetch_object()){
                            $t = tumb($req->capa);
                            echo "<tr><td><img src='$t'
                            class='mini'/>";
                            echo "<td><a href='detalhes.php?cod=$req->cod'>$req->nome</a>";
                            echo "<br>($req->genero) $req->produtora";
                            if(is_admin()){
                                echo "<td>";
                                echo "<i class='material-icons'>add_circle</i> ";  
                                echo "<i class='material-icons'>edit</i> ";
                                echo "<i class='material-icons'>delete</i>";
                               
                            }elseif (is_editor()) { 
                                echo "<td>";
                                echo "<i class='material-icons'>edit</i> ";
                
                            }
                            
                        }
                        
                    }
                }
            ?>
        </table>
    </div>
    <?php $banco->close();?>
    <?php include_once "rodape.php" ?>
</body>
</html>