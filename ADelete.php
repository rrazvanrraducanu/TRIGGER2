<?php
require_once 'connection.php';

echo "<table border='1'>
    <tr>
    <th>Nume</th>
    <th>Culoare</th>
    <th>Marime</th>
    <th>Pret</th>
    </tr>";
$sql1="SELECT * FROM flowers";
foreach ($con->query($sql1) as $row)
        {
    echo "<tr>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['culoare']."</td>";
    echo "<td>".$row['marime']."</td>";
    echo "<td>".$row['pret']."</td>";
        }
$sql="CREATE TRIGGER after_delete AFTER DELETE ON flower FOR EACH ROW
    BEGIN
    INSERT INTO flower_update(nume,status,edtime)VALUES(OLD.nume,'DELETED',NOW());
    END;";
$stmt=$con->prepare($sql);
$stmt->execute();
$nume='11111';
$sql11="CALL deleteFlori('{$nume}')";
$q=$con->query($sql11);
if($q){
    echo "Data was successfully deleted!";
}else {
echo "Vai vai vai!!!";    
}
echo "<br><br>";
echo "<table border='1'>
    <tr>
    <th>Nume</th>
    <th>Culoare</th>
    <th>Marime</th>
    <th>Pret</th>
    </tr>";
$sql3="SELECT *FROM flowers";
foreach ($con->query($sql3) as $row)
        {
    echo "<tr>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['culoare']."</td>";
    echo "<td>".$row['marime']."</td>";
    echo "<td>".$row['pret']."</td>";
        }
$sql4="SELECT *FROM flower_update";
foreach ($con->query($sql4) as $row)
        {
    echo "<tr>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>".$row['edtime']."</td>";
        }
?>

