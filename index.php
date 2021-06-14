<!DOCTYPE html>
<html>

<head>
  <title>Gestionnaire tickets Appels </title>
</head>
<body>

<form enctype="multipart/form-data" action="import-csv.php" method="post">
        <div class="input-row">
            <label class="col-md-4 control-label">Choisir un fichier CSV</label>
            <input type="file" name="file" id="file" accept=".csv">
            <br />
            <br />
            <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
            <br />
        </div>
    </form>
    <?php
    // Connect to database
    include("db_connect.php");

    $sql = "SELECT * FROM appel where id <10";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
?>
<table>
            <thead>
                <tr>               
                    <th>ID Appel</th>
                    <th>N°Compte Facturé</th>
                    <th>N°Facture</th>
                    <th>N°Abonné</th>
                    <th>Date Appel</th>
                    <th>Heure Appel</th>
                    <th>Durée/Volume Réel</th>
                    <th>Durée/Volume Facturé</th>
                    <th>Type Connexion</th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tbody>
                    <tr>
                        <td> <?php  echo $row['id']; ?> </td>
                        <td> <?php  echo $row['compteFact']; ?> </td>
                        <td> <?php  echo $row['numFact']; ?> </td>
                        <td> <?php  echo $row['numAbonné']; ?> </td>
                        <td> <?php  echo $row['dateAppel']; ?> </td>
                        <td> <?php  echo $row['heureAppel']; ?> </td>
                        <td> <?php  echo $row['duréeAppelRéel']; ?> </td>
                        <td> <?php  echo $row['duréeAppelFact']; ?> </td>
                        <td> <?php  echo $row['typeConnexion']; ?> </td>
                    </tr>
            <?php } ?>
                </tbody>
        </table>
<?php } ?>
</body>
</html>