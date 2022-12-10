<?php
    session_start();//criar a sessao para ver se tem seção on
    ob_start();//previnir erro de redirecionamento, limpando buffer de redirecionamento
    session_destroy();//destruir essa seção
    $_SESSION['msg'] = "<p style='color: green'>Deslogado com sucesso!</p>";

    header("Location: index.php");
?>
<!-- unset($_SESSION['id'], $_SESSION['nome'])//mesma coisa que o session_destroy -->
