<?php
    require ('database/database.php'); 
    //Require() : a função require() importa arquivos, porém, caso o mesmo não seja encontrado, será levantado uma exceção e a execução é finalizada. Essa é uma maneira de interrompermos a execução dos scripts caso alguma anomalia ocorra.

    $cpf = $_POST["cpf"];
    $dataNascimento = $_POST["dataNascimento"];
    $nome = $_POST["nome"]; 
    $email = $_POST["email"];      
    $sexo = $_POST["sexo"];    
    $usuario = $_POST["usuario"]; //name do input
    $senha = $_POST["senha"];
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $stmt = $connect->prepare("INSERT INTO usuarios (cpf, dataNascimento, nome, email, sexo, usuario, senha_usuario) VALUES (:cpf, :dataNascimento, :nome, :email, :sexo,  :usuario, :senha_usuario)");

        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':dataNascimento', $dataNascimento);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':senha_usuario', $senhaHash);

        $stmt->execute();
        // echo "Cadastro com sucesso!";
        $id = $connect->lastInsertId();

        $result["success"]["message"] = "Cadastrado com sucesso!"; //criamos o array para devolver o resultado do insert numa mensagem de sucesso.

        $result["data"]["id"] = $id; //criamos o array para devolver o resultado do insert com os dados inseridos.
        $result["data"]["cpf"] = $cpf;
        $result["data"]["dataNascimento"] = $dataNascimento;
        $result["data"]["nome"] = $nome;
        $result["data"]["email"] = $email;
        $result["data"]["sexo"] = $sexo;
        $result["data"]["usuario"] = $usuario;
        $result["data"]["senha"] = $senhaHash;

        header('Content-Type: text/json'); //para ser enviado no formato json.
        echo json_encode($result); //exibir o resultado.
    } catch (PDOException $erro) {
        echo "connect failed: " . $erro->getMessage();
    }
?>
