<?php
    require ('database/database.php'); 
    //Require() : a função require() importa arquivos, porém, caso o mesmo não seja encontrado, será levantado uma exceção e a execução é finalizada. Essa é uma maneira de interrompermos a execução dos scripts caso alguma anomalia ocorra.

    $capa = $_POST["capa"]; //name do input
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"]; 

    try {
        $stmt = $connect->prepare("INSERT INTO foto (capa, titulo, descricao)
        VALUES (:capa, :titulo, :descricao)");
        $stmt->bindParam(':capa', $capa);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        
        $stmt->execute();
        // echo "Cadastro com sucesso!";
        $id = $connect->lastInsertId();

        $result["success"]["message"] = "Cadastrado com sucesso!"; //criamos o array para devolver o resultado do insert numa mensagem de sucesso.

        $result["data"]["id"] = $id; //criamos o array para devolver o resultado do insert com os dados inseridos.
        $result["data"]["capa"] = $capa;
        $result["data"]["titulo"] = $titulo;
        $result["data"]["descricao"] = $descricao;
        
        header('Content-Type: text/json'); //para ser enviado no formato json.
        echo json_encode($result); //exibir o resultado.
    } catch (PDOException $erro) {
        echo "connect failed: " . $erro->getMessage();
    }
?>