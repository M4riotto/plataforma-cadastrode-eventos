<?php

    require('database/database.php');

    try {
        $id = '';
        if (isset($_GET['id'])){
            $id = $_GET['id'];
        }

        $stmt = $connect->prepare("SELECT * FROM eventos as ev INNER JOIN participantes as par on ev.id = par.id WHERE ev.id = :id AND par.id = :id;");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $count = $stmt->rowCount();

        if ($count == 1) {
            $agenda = $stmt->fetch(PDO::FETCH_ASSOC);
            $result["success"]["message"] = "Compromisso encontrado com sucesso!";
            $result["data"] = $agenda;
        } else {
            $result["error"]["message"] = "ID: $id não encontrado!";
        }

        header('Content-Type: text/json');
        echo json_encode($result);

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

?>

