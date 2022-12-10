<?php
if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){//isset = existir
    $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Necessário realizar o login para acessar a página!</p>";
    header("Location: index.php");
}?>