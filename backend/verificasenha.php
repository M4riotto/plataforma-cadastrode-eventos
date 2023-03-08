<?php
    session_start();
    require_once "database/database.php";

    $email = $_SESSION['email'];

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if (!empty($dados['SendLogin'])) {
        $query_usuario = "SELECT senha_usuario
                          FROM usuarios 
                          WHERE email = :email
                          LIMIT 1";
    
        $result_usuario = $connect->prepare($query_usuario);
        $result_usuario->bindParam(':email', $email, PDO::PARAM_STR);
        $result_usuario->execute();

        if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])) {
                header("Location: recuperarSenha.php");
                exit;
            } else {
               echo $_SESSION['msg'] = "<span style='color: #ff0000'>Erro: Token inválido!</span>";
            }
        } else {
           echo $_SESSION['msg'] = "<span style='color: #ff0000'>Erro: inválido!</span>";
        }   
    }
?>

<!DOCTYPE html>
<html lang="pt - BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de senha</title>
    <style>
        body, html{
            background-color: #3ecbf9;
            height: 100%;
        }
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        form > input{
            border-radius: 7px;
            border: 2px solid #ffbb9a;
            padding: 10px;
        }
        form{
            display:flex;
            flex-direction: column;

        }

        form > button{
            padding: 5px;
            border: 2px solid #ffbb9a;
        }

        form > button:hover{
            background-color: #007affcc;
        }
        a > button{
            padding: 5px;
            border: 2px solid #ffbb9a;
            width: 100%;
        }
        a > button:hover{
            background-color: #007affcc;
        }

        .caixa{
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: aliceblue;
            box-shadow: 8px 8px 8px 7px black;
        }
    </style>
</head>
<body>
    <div class="caixa">
    <form action="" method="POST">
        <h2>confirmação de token</h2>
        <label for="token"></label>
        <input type="text" id="token" name="senha_usuario" placeholder="Digite seu token"><br>
        <button type="submit" name="SendLogin" value="ok">Enviar</button>
        
    </form><br>
    <a href="index.php"><button>Voltar</button></a></div>
    
</body>
</html>

