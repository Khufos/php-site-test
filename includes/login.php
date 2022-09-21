<?php
session_start();

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = '';
    $_SESSION['nome'] = '';
    $_SESSION['tipo'] = '';
};
  
function cripto($senha) {
    $c = '';
    for($pos = 0; $pos < strlen($senha); $pos++) {
        $letra = ord($senha[$pos]) + 1;
        $c .= chr($letra);
    }
    return $c;
}

function gerarHash($senha){
    $txt = cripto($senha);
    $hash = password_hash($txt, PASSWORD_DEFAULT);
    return $hash;
}

function testarHash($senha, $hash){
    $ok = password_verify($senha, $hash);
    return $ok;
    
}

function is_logado(){
    if(empty($_SESSION['user'])){
        return false;

    }else{
        return true;
    }


}
function is_admin(){
    $t = $_SESSION['tipo'] ?? null;
    if (is_null($t)){
        return false;
    }else{
        if($t == 'admin'){
            return true;
        }else{
            return false;
        }
    }
}

function is_editor() {
    $a = $_SESSION['tipo'] ?? null;
    if (is_null($a)){
        return false;
    }else{
        if($a=="editor"){
            return true;
        }else{
            return false;
        }
    }
}   
#$original ='rapaz';
#echo "$original   --- ";
#echo cripto($original);
#echo "<br>";
#echo gerarHash($original) ."     ---   ";    
#echo testarHash('kpbp','$2y$10$3F1LuknG5lSB0JgHOF4gMO8LICjrzCzjquP6HoED.f2Sn2LUjjxEG')? "sim":"Nao" ;

?>
