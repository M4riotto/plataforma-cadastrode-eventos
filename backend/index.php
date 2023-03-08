<?php
    session_start();
    ob_start();
    require 'database/database.php'; // include_once = incluir apena 1 vez 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lOGIN</title>
</head>

<style>
    :root{
    --color1: #ffbb9a;
    --color2: #ffed6e;
    --color3: #091fb4;
    --color4: #0368f6;
    --color5: #3ecbff;
    }
    html,body{
        height: 100%;
    }
    body{
        max-width: 400px;
        padding: 0;
        margin: 0 auto !important;
        background: var(--color5);
    }
    #wrapper{
        height: 100%;
        display:flex;
        justify-content: center;
        align-items: center;
    }
    .container{
        background-color: #e5e5e5fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 10px 5px 5px black;
    }
    .erro{
        display:flex;  
        flex-direction:column;    
        align-items: center;       
    }
    #login{
        display:flex;       
        justify-content: center;
    }
    #login label{
        font-size:20px;
        weight:bolder;
    }
    form{
        padding:30px;
    }
    form > input[type=text],input[type=password]{
        border: none;
        padding: 10px;
        border-radius: 10px;
        background-color: #c7c7c794;
    }
    form > div > input[type=submit],input[type=button]{
        border: none;
        border-radius: 5px;
        font-size: 25px;
        display: flex;
        width: 100%;
        background-color: #009affcc;
        justify-content: center;
        height: 35px;
        
    }
    form > div > input[type=submit]:hover,input[type=button]:hover{
        background-color: #007affcc;
    }
    form > div{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
</style>

<body>
    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);//filter = receber todos os dados do form em um array (método   que esta usando, receber os dados como string)
    
        if (!empty($dados['SendLogin'])) { //empty = vazio || só acessa esse if qnd o usuario clicar no botao
            $query_usuario = "SELECT id, nome, email, usuario, senha_usuario 
                              FROM usuarios 
                              WHERE usuario = :usuario  
                              LIMIT 1"; //salvando esse texto na variavel
    
            $result_usuario = $connect->prepare($query_usuario);//fazendo o select no BDD
            $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR);//bind param = substituir o valor
            $result_usuario->execute();//executando a query
        
            if(($result_usuario) AND ($result_usuario->rowCount() != 0)){//se a qtnd de linha que encontrou no BDD for ! 0,     então acessar o IF 
            
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);//lendo o valor com o fetch
                //var_dump($row_usuario);
            
                if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){//verificar a senha passando para   a variavel $dados o nome do botão || $row_usuario = a senha que esta no banco de dados criptografada. Ou seja     fazendo a comparação
                
                    $_SESSION['id'] = $row_usuario['id'];//SESSION palavra reservada
                    $_SESSION['nome'] = $row_usuario['nome'];//passando o id e o nome para a variavel global com a informação   que vem do BDD 
                    header("Location: Eventos_Cadastrados.php");//se tudo der certo, redirecionar para essa pagina
                }else{
                    $_SESSION['msg'] = "<span style='color: #ff0000'>Erro: Usuário ou senha inválida!</span>";
                }
            }else{
                $_SESSION['msg'] = "<span style='color: #ff0000'>Erro: Usuário ou senha inválida!</span>";
            }   
        }
    ?>
    <div id="wrapper">
        <div class="container">
            <div class="erro">
                <h1>Tela de login</h1>
                <?php
                if(isset($_SESSION['msg'])){//isset = existir
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);//destrua apenas essa 
                }?>
            </div>
            <div id="login">
                <form method="POST" action="">     
                    <label>Usuário:</label>
                    <input type="text" name="usuario" placeholder="Digite o usuário" value="<?php if(isset($dados['usuario'])){echo $dados['usuario']; } ?>"><br><br> <!--mantendo o que o cara digitou caso ele erre algo-->
                    <label>Senha:</label>
                    <input type="password" name="senha_usuario" placeholder="Digite a senha" value="<?php if(isset($dado['senha_usuario'])){ echo $dados['senha_usuario']; } ?>"> <br><br>
                        
                    <div>
                        <input type="submit" value="Acessar" name="SendLogin"><!--sendLogin nome do botão--><br/>
                        <input type="button" value="Voltar" name="voltar" onclick="voltarpagina()">
                        <a href="esqueceu_a_senha.php"><p>Esqueceu a senha</p></a>
                    </div>
                </form><br><br>     
            </div>
        </div>
    </div>
</body>
<script>
    function voltarpagina(){
        window.location.replace('../index.html')
    }
</script>
</html>