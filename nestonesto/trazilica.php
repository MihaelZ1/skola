<?php

$mysqli = mysqli_connect("localhost", "root", "", "automobili");

$marka = $_GET['marka'] ?? '';
$god = $_GET['god_proizvodnje'] ?? '';
$prije = $_GET['prije'] ?? 'prije';

if (!mysqli_connect_errno()) {

    // Provjera godine
    if (!is_numeric($god)) {
        $god = 0;
    }

    // Odabir operatora
    $op = ($prije == "prije") ? "<" : ">";

    // SQL upit
    $sql = "
        SELECT *
        FROM auto
        WHERE marka LIKE '%$marka%'
        AND god_proizvodnje $op $god
    ";

    $result = mysqli_query($mysqli, $sql);

    if ($result) {

        if (mysqli_num_rows($result) == 0) {
            echo "Nema nijedne stavke u bazi.";
        } else {

            echo "<table border='1'>";
            echo "<tr>
                    <th>id</th>
                    <th>marka</th>
                    <th>max_brzina</th>
                    <th>god_proizvodnje</th>
                    <th>edit</th>
                    <th>briši</th>
                    <th>briši</th>
                  </tr>";

            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['marka']}</td>
                        <td>{$row['max_brzina']}</td>
                        <td>{$row['god_proizvodnje']}</td>
                        <td><a href='edit_auto_forma.php?id={$row['id']}'>edit</a></td>
                        <td><a href='action.php?action=brisi_auto_iz_baze&id={$row['id']}'>briši</a></td>
                        <td>
                            <form action='action.php' method='GET'>
                                <input type='hidden' name='id' value='{$row['id']}' />
                                <input type='hidden' name='action' value='brisi_auto_iz_baze' />
                                <input type='submit' value='Briši' />
                            </form>
                        </td>
                      </tr>";
            }

            echo "</table>";
            mysqli_free_result($result);
        }

    } else {
        echo "Upit je neuspješno izvršen!";
    }

} else {
    echo "Greška kod spajanja na bazu! " . mysqli_connect_error();
}

?>

<form action="trazilica.php" method="GET">
    Marka: <input type="text" name="marka"><br>
    Godina proizvodnje: <input type="text" name="god_proizvodnje"><br>
    <input type="radio" name="prije" value="prije" checked> prije<br>
    <input type="radio" name="prije" value="poslije"> poslije<br>
    <input type="submit" value="Traži">
</form>
