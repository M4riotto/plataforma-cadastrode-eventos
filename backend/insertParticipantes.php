<?php
    require ('database/database.php'); 
    //Require() : a função require() importa arquivos, porém, caso o mesmo não seja encontrado, será levantado uma exceção e a execução é finalizada. Essa é uma maneira de interrompermos a execução dos scripts caso alguma anomalia ocorra.

    $cpf = $_POST["cpf"]; //name do input
    $nomeP = $_POST["nomeP"];
    $sexo = $_POST["sexo"]; 
    $descricaoP = $_POST["descricaoP"];

    try {
        $stmt = $connect->prepare("INSERT INTO participantes (cpf, nomeP, sexo, descricaoP)
        VALUES (:cpf, :nomeP, :sexo, :descricaoP)");
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nomeP', $nomeP);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':descricaoP', $descricaoP);
        
        $stmt->execute();
        // echo "Cadastro com sucesso!";
        $id = $connect->lastInsertId();

        $result["success"]["message"] = "Cadastrado com sucesso!"; //criamos o array para devolver o resultado do insert numa mensagem de sucesso.

        $result["data"]["id"] = $id; //criamos o array para devolver o resultado do insert com os dados inseridos.
        $result["data"]["cpf"] = $cpf;
        $result["data"]["nomeP"] = $nomeP;
        $result["data"]["sexo"] = $sexo;
        $result["data"]["descricaoP"] = $descricaoP;
        
        header('Content-Type: text/json'); //para ser enviado no formato json.
        echo json_encode($result); //exibir o resultado.
    } catch (PDOException $erro) {
        echo "connect failed: " . $erro->getMessage();
    }
?>