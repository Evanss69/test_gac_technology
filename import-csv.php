<?php
  // Connect to database
  include("db_connect.php");
  if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
      
      $file = fopen($fileName, "r");
      //$row = 0;
      while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {

          //if($row <3){$row++;continue;}
          //convertir colonne 3 format date pas meme que celui de la bd
        $sql = "INSERT into appel (compteFact,numFact,numAbonné,dateAppel,heureAppel,duréeAppelRéel,duréeAppelFact,typeConnexion) 
        values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] .  "')";
            //print_r($sql);
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
  }
  //Retourner à la page index.php
  header('Location: index.php');
  exit;


?>