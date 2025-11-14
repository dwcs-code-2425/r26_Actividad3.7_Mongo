<?php
require_once 'connection.php';
function getPublishers(): array
{
    try {

        $con = getConnection();

        $stmt = $con->prepare("SELECT * FROM publishers ORDER BY publisher_id");

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    finally{
        $con = null;
        $stmt = null;
    }
}

function showPublishers(array $data){
    if($data){
        echo "<table class='table'><tr><th>Id</th> <th> Nombre </th> </tr> <tbody>";

        foreach ($data as $fila) {
            echo "<tr> <td> {$fila["publisher_id"]}</td> <td>{$fila["name"]} </td></tr>";
        }
        echo "</tbody></table>";
    }
    else{
        showMsg("No se encontraron registros", "primary");
    }
}

function showMsg(string $msg, string $claseCSS)
{
    echo "<div class=\"alert alert-$claseCSS\" role=\"alert\">
  $msg
</div>
";
}

function insertPublisher(string $nombre): bool|string{
    try {
        $con = getConnection();
        $con->beginTransaction();
        $stmt = $con->prepare("INSERT INTO publishers(name) VALUES (?)");
        $stmt->bindParam(1, $nombre);
        $stmt->execute();
        $id = $con->lastInsertId();
        $con->commit();
        return $id;
    } catch (PDOException $e) {
        $con->rollBack();
        error_log("Ha ocurrido una excepción insertando en publishers: ". $e->getMessage());
        throw $e;
    }
    finally{
        $con = null;
        $stmt = null;

    }

}
