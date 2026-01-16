<?php
require_once 'connection.php';
require_once __DIR__.'/vendor/autoload.php';
function getPublishers()//: array
{
    try {

         $con = new MongoDB\Client();
        $col = $con->biblioteca->editorial;
        return $col->find([], ["sort" => ["name" => 1]]); //->toArray()


        // $stmt = $con->prepare("SELECT * FROM publishers ORDER BY publisher_id");

        // $stmt->execute();

        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // return $result;
    }
    finally{
        $con = null;
        $stmt = null;
    }
}

function showPublishers( $data){
    if($data){
        echo "<table class='table'><tr><th>Id</th> <th> Nombre </th> </tr> <tbody>";

        foreach ($data as $fila) {
            echo "<tr> <td> {$fila["_id"]}</td> <td>{$fila["name"]} </td></tr>";
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
        $con = new MongoDB\Client();
        $col = $con->biblioteca->editorial;
       $result= $col->insertOne(["name" => $nombre]);
       return $result->getInsertedId();
        // $con->beginTransaction();
        // $stmt = $con->prepare("INSERT INTO publishers(name) VALUES (?)");
        // $stmt->bindParam(1, $nombre);
        // $stmt->execute();
        // $id = $con->lastInsertId();
        // $con->commit();
       // return $id;
    } catch (Exception $e) {
       // $con->rollBack();
        error_log("Ha ocurrido una excepción insertando en publishers: ". $e->getMessage());
        throw $e;
    }
    

}
