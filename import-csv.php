<?php
  // Connect to database
  include("db_connect.php");
  if (isset($_POST["import"])) { 
    $fileName = "test_technique_doc.csv";
      $file = fopen($fileName, "r");
      $row = 0;

      while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
          if($row <3){$row++;continue;}
          $j= substr($column[3],0,2);
          $m = substr($column[3],3,2);
          $y= substr($column[3],6,8);
          $chaine=" " . $y . "-" . $m . "-" . $j . "";

        $sql = "INSERT into appel (compteFact,numFact,numAbonné,dateAppel,heureAppel,duréeAppelRéel,duréeAppelFact,typeConnexion) 
        values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $chaine . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] .  "')";

        $result = mysqli_query($conn, $sql);

        if (! empty($result)) {
          $type = "success";
          $message = "Les Données sont importées dans la base de données";
        } else {
          $type = "error";
          $message = "Problème lors de l'importation de données CSV";
        }
      }
  }

  //Retourner à la page index.php
  header('Location: index.php');
  exit;


?>
