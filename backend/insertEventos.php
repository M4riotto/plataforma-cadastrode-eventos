<?php
    require ('database/database.php'); 
    //Require() : a função require() importa arquivos, porém, caso o mesmo não seja encontrado, será levantado uma exceção e a execução é finalizada. Essa é uma maneira de interrompermos a execução dos scripts caso alguma anomalia ocorra.

    $nome = $_POST["nome"];//name do input
    $capa = $_POST["capa"]; 
    $categoria = $_POST["categoria"];
    $limiteP = $_POST["limiteP"];
    $dia = $_POST["dia"];
    $horario = $_POST["horario"];
    $endereco = $_POST["endereco"];
    $municipio = $_POST["municipio"];
    $uf = $_POST["uf"];
    $descricao = $_POST["descricao"];

    try {
        $stmt = $connect->prepare("INSERT INTO eventos (nome, capa, categoria, limiteP, dia, horario, endereco, municipio, uf, descricao)
        VALUES (:nome, :capa, :categoria, :limiteP, :dia, :horario, :endereco, :municipio, :uf, :descricao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':capa', $capa);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':limiteP', $limiteP);
        $stmt->bindParam(':dia', $dia);
        $stmt->bindParam(':horario', $horario);
        $stmt->bindParam(':endereco', $endereco);  
        $stmt->bindParam(':municipio', $municipio);
        $stmt->bindParam(':uf', $uf);
        $stmt->bindParam(':descricao', $descricao);
        
        $stmt->execute();
        // echo "Cadastro com sucesso!";
        $id = $connect->lastInsertId();

        $result["success"]["message"] = "Cadastrado com sucesso!"; //criamos o array para devolver o resultado do insert numa mensagem de sucesso.

        $result["data"]["id"] = $id; //criamos o array para devolver o resultado do insert com os dados inseridos.
        $result["data"]["nome"] = $nome;
        $result["data"]["capa"] = $capa;
        $result["data"]["categoria"] = $categoria;
        $result["data"]["limiteP"] = $limiteP;
        $result["data"]["dia"] = $dia;
        $result["data"]["horario"] = $horario;
        $result["data"]["endereco"] = $endereco;
        $result["data"]["municipio"] = $municipio;
        $result["data"]["uf"] = $uf;
        $result["data"]["descricao"] = $descricao;
        
        header('Content-Type: text/json'); //para ser enviado no formato json.
        echo json_encode($result); //exibir o resultado.
    } catch (PDOException $erro) {
        echo "connect failed: " . $erro->getMessage();
    }
?>