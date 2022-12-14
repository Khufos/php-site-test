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
    <title>Edição de dados Usuário.</title>
</head>

<body>
    <div id="corpo">
        <?php
        if (!is_logado()) {
            echo msg_erro("Efetue o <a href='user-login.php'>Login</a> para editar");
        } else {
            if (!isset($_POST['usuario'])) {
                include "user-edit-form.php";
            } else {
                $usuario= $_POST['usuario'] ?? null;
                $nome = $_POST['nome'] ?? null;
                $tipo = $_POST['tipo'] ?? null;
                $senha1 = $_POST['senha1'] ?? null;
                $senha2 = $_POST['senha2'] ?? null;
                $senha = gerarHash($senha1);
                $q = " UPDATE usuarios SET usuario = '$usuario', nome = '$nome' ";
                if (empty($senha1) || is_null($senha1)) {
                    echo msg_aviso("senha antiga foi mantida");
                } else {
                    if ($senha1 === $senha2) {
                        $q .= ", senha='$senha'";
                    } else {
                        echo msg_erro("Senhas não confere");
                    }
                }
            $q .= " where usuario='".$_SESSION['user']."'";
            if($banco->query($q)){
                echo msg_sucesso("usuario alterado com sucesso");
                logout();
                echo msg_aviso("Por segurança ,efetue o <a href='user-login.php'>login</a> novamente");
            }else{
                echo msg_erro(" Não foi possivel altera os dados ");
            }
            }
        }
        ?>
        <?php echo voltar() ?>
    </div>
    <?php require_once "rodape.php"; ?>
</body>

</html>