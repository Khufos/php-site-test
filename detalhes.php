<!DOCTYPE html>
<?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        require_once "includes/login.php";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>Detalhes do jogo</title>
</head>
<body>

    <div id="corpo">
        <?php include "topo.php"; ?>
		<table class="detalhes">
        <?php
            $codigo = $_GET['cod'] ?? 0;
            // aqui faz a busca dos dados no banco
            $busca = $banco->query("select * from jogos where cod='$codigo'");
            
        ?>
        <h1>Detalhes do jogo</h1>
        <table class="detalhes">
        <?php
            if(!$busca){
                echo "Busca falhou! $banco->error";
            }else{
                if($busca->num_rows == 1){
                    // com os dados dentro do da busca e voce passa o conteudo para dentro do req e depois filtra
                    // os dados 
                    $req= $busca->fetch_object();
                    $t = tumb($req->capa); // funcao de mostra imagem com detector de error
                    echo "<tr><td rowspan ='3'><img src='$t' class='full'/>";
                    echo "<td><h2>$req->nome</h2>";
                    echo "Nota: " . number_format($req->nota , 1) . "/10.0";
                    if(is_admin()){
                        echo "<td>";
                        echo "<i class='material-icons'>add_circle</i> ";  
                        echo "<i class='material-icons'>edit</i> ";
                        echo "<i class='material-icons'>delete</i>";
                       
                    }elseif (is_editor()) { 
                        echo "<td>";
                        echo "<i class='material-icons'>edit</i> ";
        
                    }
                    echo "<tr><td>$req->descricao";
                   

                }else{
                    echo "<p> Não achou nenhum registro </p>";
                }
            }
           
        ?>
        </table> 
        <?php echo voltar() ?>
        
    </div>
    <?php include_once "rodape.php" ?>
</body>
</html>