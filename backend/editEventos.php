<?php
    require ('database/database.php'); 
    //Require() : a função require() importa arquivos, porém, caso o mesmo não seja encontrado, será levantado uma exceção e a execução é finalizada. Essa é uma maneira de interrompermos a execução dos scripts caso alguma anomalia ocorra.

    $id = $_POST["id"];
    //participante
    $cpf = $_POST["cpf"]; 
    $nomeP = $_POST["nomeP"];
    $sexo = $_POST["sexo"]; 
    $descricaoP = $_POST["descricaoP"];
    //eventos
    $nome = $_POST["nome"];
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
        $stmt = $connect->prepare("UPDATE eventos  AS ev INNER JOIN participantes AS par  ON ev.id = par.id SET ev.nome = :nome , ev.capa = :capa, ev.categoria = :categoria, ev.limiteP = :limiteP,  ev.dia = :dia, ev.horario = :horario, ev.endereco = :endereco, ev.municipio = :municipio, ev.uf = :uf, ev.descricao = :descricao, par.nomeP = :nomeP, par.descricaoP = :descricaoP, par.cpf = :cpf, par.sexo = :sexo
        WHERE ev.id = :id AND par.id = :id;");

        $stmt->bindParam(':id', $id);
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
        $stmt->bindParam(':nomeP', $nomeP);
        $stmt->bindParam(':descricaoP', $descricaoP);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':sexo', $sexo);

        $stmt->execute();
        // echo "Cadastro com sucesso!";
        $line = $stmt->rowCount();

        if ($line = 1) {
            $result["success"]["message"] = "Editado com sucesso!";
                        
            $result["data"]["id"] = $id; //criamos o array para devolver o resultado do insert com os dados inseridos.
            $result["data"]["nome"] = $nome;
            $result["data"]["capa"] = $capa;
            $result["data"]["limiteP"] = $limiteP;
            $result["data"]["dia"] = $dia;
            $result["data"]["horario"] = $horario;
            $result["data"]["endereco"] = $endereco;
            $result["data"]["municipio"] = $municipio;
            $result["data"]["uf"] = $uf;
            $result["data"]["descricao"] = $descricao;
            $result["data"]["nomeP"] = $nomeP;
            $result["data"]["descricaoP"] = $descricaoP;
            $result["data"]["cpf"] = $cpf;
            $result["data"]["sexo"] = $sexo;
        } else {
            $result["error"]["message"] = "ID: $id não encontrado";
        }

        header('Content-Type: text/json'); //para ser enviado no formato json.
        echo json_encode($result); //exibir o resultado.

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>  