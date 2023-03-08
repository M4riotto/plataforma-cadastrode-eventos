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

                        $_SESSION['sucess'] = "<span style='color: green'>Senha alterada com sucesso!</span>";
                        //header("Location: ./index.php");
                    } else {
                        $_SESSION['erro'] = "<span style='color: #ff0000'>Erro: Algo deu errado! Verifique sua senha</span>";
                    }
                }
?>


<!DOCTYPE html>
<html lang="pt - BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../fontawesome/css/all.css">
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
        form > .flex > input{
            border-radius: 7px;
            border: 2px solid #ffbb9a;
            padding: 10px;
            margin-right:10px;
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
        .flex{
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="caixa">
    <form action="" method="post">
        <h2>Recuperação de senha</h2>

        <?php
           if(isset($_SESSION['sucess'])){//isset = existir
            echo $_SESSION['sucess'];
            unset($_SESSION['sucess']);//destrua apenas essa 
           }else{
            echo $_SESSION['erro'];
            unset($_SESSION['erro']);
           }
        ?>

        <div id="error"></div>

        <label for="senha">Nova senha</label>

        <div class="flex">
            <input type="password" id="senha" name="senha" placeholder="nova senha">
            <span class="" >
                <i id="icon" class="fa fa-eye" onclick="mostrarSenha()"></i>
            </span>
        </div>

        <br/>

        <label for="confirmarsenha">Confirmação de senha</label>

        <div class="flex">
            <input type="password" id="confirmarsenha" name="confirmarsenha" onkeyup="verificaSenha()" placeholder="confirme sua senha">
            <span class="" >
                <i id="icon2" class="fa fa-eye" onclick="mostrarSenha2()"></i>
            </span>
        </div><br/>

        <button type="submit" name="ok" value="ok">Enviar</button>
        
    </form><br>
    <a href="index.php"><button>Voltar</button></a></div>

    <script>
        function verificaSenha() {
            var senha = document.querySelector("#senha").value
            var confirmasenha = document.querySelector("#confirmarsenha").value
            var inputC = document.querySelector("#confirmarsenha")
            var inputSenha = document.querySelector("#senha")

            var error = document.querySelector("#error");
            var msgErr = document.createElement("p");

            if (senha === confirmasenha) {
                inputSenha.style.border = '2px solid green';
                inputC.style.border = '2px solid green';
                inputC.style.backgroundColor = 'white';

                var apagarErr = error.removeChild(msgErr);
                error.removeChild(msgErr);
            } else {
                inputC.style.border = '2px solid red';
                inputC.style.backgroundColor = 'red';
                inputSenha.style.border = 'none';

                // msgErr.innerHTML = "As senhas não conferem. Por favor, verifique sua senha.";
                // msgErr.style.color = "red";

                // error.appendChild(msgErr);

            }
        }
        function mostrarSenha(){
            let senha = document.querySelector("#senha");
            let toggleIcon = document.querySelector("#icon");

        if (senha.type === "password") {
            senha.type = "text";
            toggleIcon.className = "fa fa-eye-slash";
        } else {
            senha.type = "password";
            toggleIcon.className = "fa fa-eye";
        }
    }
    function mostrarSenha2(){
            let senha2 = document.querySelector("#confirmarsenha");
            let toggleIcon2 = document.querySelector("#icon2");

        if (senha2.type === "password") {
            senha2.type = "text";
            toggleIcon2.className = "fa fa-eye-slash";
        } else {
            senha2.type = "password";
            toggleIcon2.className = "fa fa-eye";
        }
    }
    </script>
    
</body>
</html>