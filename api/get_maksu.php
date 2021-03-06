<?php
include "errorDetector.php";
include "connection.php";

session_start();

//Valmistellaan kysely,jolla noudetaan käyttäjän e-laskujen tapahtumat.
$sql = $db->prepare("SELECT Tilinro, Nimi, Viesti, Viite, Erapaiva, Summa FROM Maksu
  JOIN Pankkitili ON  Pankkitili.idPankkitili = Maksu.idPankkitili
  JOIN Asiakas1_Pankkitili ON Pankkitili.idPankkitili = Asiakas1_Pankkitili.idPankkitili
  JOIN Asiakas1 ON Asiakas1_Pankkitili.idAsiakas = Asiakas1.idAsiakas
  JOIN Tunnus ON Asiakas1.idAsiakas = Tunnus.idAsiakas
  WHERE Ktunnus = ?;");

//Suoritetaan kysely
   $sql->execute(array($_SESSION['username']));


   //Muotoilu ja sarakkeiden nimeäminen.
    echo"<div class = 'taulukko'>";
    echo "<table border = '1'>
    <tr>
    <th>Tilinro</th>
    <th>Nimi</th>
    <th>Viesti</th>
    <th>Viite</th>
    <th>Erapaiva</th>
    <th>Summa</th>
    </tr>";

    while($row = $sql->fetch())
    {
        echo "<tr>";
        echo "<td>" . $row['Tilinro'] . "</td>";
        echo "<td>" . $row['Nimi'] . "</td>";
        echo "<td>" . $row['Viesti'] . "</td>";
        echo "<td>" . $row['Viite'] . "</td>";
        echo "<td>" . $row['Erapaiva'] . "</td>";
        echo "<td>" . $row['Summa'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
?>
