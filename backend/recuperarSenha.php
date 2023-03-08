<?php
    session_start();
    require "database/database.php";

    $erro = array();
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (!empty($dados['ok'])) { //empty = vazio || só acessa esse if qnd o usuario clicar no botao

        $novasenha = $_POST['confirmarsenha'];
        $senhacripto = password_hash($novasenha, PASSWORD_DEFAULT);
        
                    if (1==1) {
                        $email = $_SESSION['email'];
                        $update = "UPDATE usuarios set senha_usuario = '$senhacripto' WHERE email = '$email'";
                        
                        $stmt = $connect->prepare($update);//fazendo o update no BDD

                        $stmt->execute();

                        echo $_SESSION['sucess'] = 'Senha alterada com sucesso';
                        header("Location: ./index.php");
                    } else {
                        $_SESSION['msg'] = 'Algo deu errado';
                        echo $_SESSION['msg'];
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
            background-color: #3ecbff;
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
    <form action="" method="post">
        <h2>Recuperação de senha</h2>
        <label for="senha">Nova senha</label>
        <input type="text" id="senha" name="senha" placeholder="nova senha">
        <label for="confirmarsenha">Confirmação de senha</label>
        <input type="text" id="confirmarsenha" name="confirmarsenha" placeholder="confirme sua senha"><br>
        <button type="submit" name="ok" value="ok">Enviar</button>
        
    </form><br>
    <a href="index.php"><button>Voltar</button></a></div>
    
</body>
</html>