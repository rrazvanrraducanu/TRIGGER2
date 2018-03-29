<?php
require_once 'connection.php';
echo "<table border='1'>
    <tr>
    <th>Nume</th>
    <th>Culoare</th>
    <th>Marime</th>
    <th>Pret</th>
    </tr>";
$sql1="SELECT *FROM flowers";
foreach ($con->query($sql1) as $row)
        {
    echo "<tr>";
    echo "<td>".$row['nume']."</td>";
    echo "<td>".$row['culoare']."</td>";
    echo "<td>".$row['marime']."</td>";
    echo "<td>".$row['pret']."</td>";
        }
$sql="CREATE TRIGGER MysqlTrigger1 BEFORE UPDATE ON flowers FOR EACH ROW
    BEGIN
    SET NEW.nume=UPPER(NEW.nume)
    END;";
$stmt=$con->prepare($sql);
$stmt->execute();
$nume="trandafiri";
$culoare="rosii";
$marime="mari";
$pret="333";
$sql2="CALL updateFlori('{$nume}','{$culoare}','{$marime}','{$pret}')";
$q=$con->query($sql2);
if($q)
    echo "Data was successfully updated";
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
?>
