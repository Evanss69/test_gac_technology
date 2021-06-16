<!DOCTYPE html>
<html style='background-color: lightgrey;'>

<head>
<meta charset="UTF-8">
  <title>Gestionnaire tickets d'appels </title>
</head>
<body style='width:100%;margin:auto;text-align:center;'>
<header>
    <h1 style='text-align:center;'>Gestionnaire tickets d'appels</h1>
</header>
<form enctype="multipart/form-data" action="import-csv.php" method="post" style='text-align:center;'>
        <div class="input-row">
            <button type="submit" id="submit" name="import" class="btn-submit" style='margin:50px;text-align:center;'>Importer le fichier CSV</button>
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
<div style='width:100%;height:100%;display:flex;justify-content:center;'>
<table style='text-align:center;margin:20px;padding:20px;'>
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
</div>
<?php include("util.php") ;
    $dureeAppel=getDuréeTotaleReelAppel();
   $totalSms=getTotalSms();
   $volumeData=getTop10VolumesDataFacturésHorsService();
?>

<div >
<h2>Durée totale réelle des appels effectués après le 15/02/2012 (inclus) :</h2>
  
    <p id='duréeTotRéelAppel' style='color: red;font-size:36px;'>"<?= $dureeAppel ?>"</p>
   
    <h2>Quantité totale de SMS envoyés par l'ensemble des abonnés :</h2>

      <p id= 'totalSms' style='color: red;font-size:36px;'>"<?= $totalSms ?>"</p>
   
    <h2>TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné :</h2>

    <div style='width:100%;height:100%;display:flex;justify-content:center;'>
    <table id='topAboVolumData' name="topAboVolumData" style='text-align:center;margin:20px;padding:20px;' >
                <tr>
                    <th>Numéro abonné</th>
                    <th>Volume data facturé</th>
                </tr>
                <?php foreach ($volumeData as $volumeAbo):?>
                    <tr>
                        <td><?= $volumeAbo['numAbonné'] ?></td>
                        <td><?= $volumeAbo['duréeAppelFact']?></td>
                    </tr>
                <?php endforeach ?>
    </div>
</div>
<?php } ?>


</body>
</html>