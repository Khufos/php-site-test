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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Login de Usuarios</title>
    <style>
        div#corpo {
            width: 270px;
            font-size: 15px;

        }

        td {
            padding: 5px;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="corpo">
        <?php
        $u = $_POST['usuario'] ?? null;
        $s = $_POST['senha'] ?? null;
        $newsenha = cripto($s);
        
        if (is_null($u) || is_null($s)) {
            require "user-login-form.php";
        } else {
            $q = "SELECT usuario,nome,senha,tipo FROM usuarios WHERE usuario = '$u' LIMIT 1";
            $busca = $banco->query($q); 
            if (!$busca) {
                echo msg_erro("Falha ao acessa o banco");
            } else {
                if ($busca->num_rows > 0) {
                    $reg = $busca->fetch_object();
                
                    if (testarHash($newsenha , $reg->senha)) {
                        print($reg->senha);
                        echo msg_sucesso('logado com sucesso');
                        $_SESSION['user'] = $reg->usuario;
                        $_SESSION['nome'] = $reg->nome; 
                        $_SESSION['tipo'] = $reg->tipo;
                        #print_r($reg);  
                    } else {
                        echo msg_erro("Senha invalida");
                        #print_r($newsenha);
                    
                    }
                }else{
                    echo msg_erro('Usuario não existe');
                }
            }
            echo voltar();
        }

        ?>
    </div>
</body>

</html>