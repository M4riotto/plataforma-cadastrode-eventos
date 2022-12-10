<?php
    require ('database/database.php'); 
    //Require() : a função require() importa arquivos, porém, caso o mesmo não seja encontrado, será levantado uma exceção e a execução é finalizada. Essa é uma maneira de interrompermos a execução dos scripts caso alguma anomalia ocorra.

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $capa = $_POST["capa"]; 
    $descricao = $_POST["descricao"];

    try {
        $stmt = $connect->prepare("UPDATE foto SET titulo = :titulo, capa = :capa, descricao = :descricao
        WHERE id = :id;");
        
        

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':capa', $capa);
        $stmt->bindParam(':descricao', $descricao);
        
        $stmt->execute();
        // echo "Cadastro com sucesso!";
        $count = $stmt->rowCount();

        if ($count == 1) {
            $result["success"]["message"] = "Editado com sucesso!";
                        
            $result["data"]["id"] = $id; //criamos o array para devolver o resultado do insert com os dados inseridos.
            $result["data"]["capa"] = $capa;
            $result["data"]["titulo"] = $titulo;  
            $result["data"]["descricao"] = $descricao;
        } else {
            $result["error"]["message"] = "ID: $id não encontrado";
        }

        header('Content-Type: text/json'); //para ser enviado no formato json.
        echo json_encode($result); //exibir o resultado.

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>  