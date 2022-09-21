<?php
echo "<p class='pequeno'>";
if(empty($_SESSION['user'])){
    echo "<a href='user-login.php'>Entrar</a> ";
 
}else{  
    echo "Olá, <strong>" . $_SESSION['nome'] . "</strong> |";
    echo  "<a href= 'user-edit.php'> Meus dados </a>";
    if (is_admin()){
        echo " | <a href= 'user-new.php'>Novo Usuario |</a>";
        echo " Novo jogo |";
    }
    echo "<a href='user-logout.php'> SAIR </a>";
   
}

echo "</p>";


