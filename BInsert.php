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
$sql="CREATE TRIGGER MysqlTrigger3 BEFORE INSERT ON flowers FOR EACH ROW
    BEGIN
    INSERT INTO flower_update(nume,status,edtime)VALUES(nume,'INSERTED',NOW());
    END;";
$stmt=$con->prepare($sql);
$stmt->execute();

$nume="lalele";
$culoare="rosii";
$marime="mari";
$pret="333";
$sql2="CALL InsertFlower('{$nume}','{$culoare}','{$marime}','{$pret}')";
//$sql2="CALL InsertFlower('11111','2222','33333','121212')";
$q=$con->query($sql2);
if($q){
    echo "Data was successfully inserted";
}  else {
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
echo "<br><br>";
echo "<table border='1'>
    <tr>
    <th>Nume</th>
    <th>Status</th>
    <th>Edtime</th>
    </tr>";
$sql4="SELECT *FROM flower_update";
foreach ($con->query($sql4) as $row)
        {
    echo "<tr>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>".$row['edtime']."</td>";
        }
?>
