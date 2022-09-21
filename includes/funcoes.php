<?php
    function tumb($arquivo) {
        $caminho = "image/$arquivo";
        if(is_null($arquivo) || !file_exists($caminho)){
            return "image/indisponivel.png";
        }else{
            return $caminho;
        }

    }


    function voltar(){
        return "<a href='index.php'><i class='material-icons' id='arrow' >arrow_back</i></a>";
    }

    function msg_sucesso($m){
        $resp = "<div class='sucesso'><i class='material-icons'>check_circle</i><p id='alinha'>$m</p></div>";
        return $resp;

    }
    
    function msg_aviso($m){
        $resp = "<div class='aviso'><i class='material-icons'>info</i><p id='alinha'>$m</p></div>";
        return $resp;
    

    }
    function msg_erro($m){
        $resp = "<div class='erro'><i class='material-icons'>error</i><p id='alinha'>$m</p></div>";
        return $resp;

    }

    function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['nome']); 
        unset($_SESSION['tipo']);
    }

    ?>

