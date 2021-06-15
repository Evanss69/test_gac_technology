<?php
  // Connect to database
  include("db_connect.php");

     function getDuréeTotaleReelAppel()
	{
        $date=new String('2012-02-15');
        $sql = "SELECT  SUM( TIME_TO_SEC(duréeAppelRéel )  ) AS totalDuréeRéelleAppel FROM appel WHERE typeConnexion like '%appel%'  AND dateAppel >= '".$date."'";
        $result = $this->mysqli_query($conn, $sql);
        if($result) {
            $result = $result->fetch_array();
            return $result['totalDuréeRéelleAppel'];
        }
        return "00:00:00";
	}
    // TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné.

     function getTop10VolumesDataFacturésHorsService()
    {
        $sql = "SELECT numAbonné,duréeAppelFact
                FROM appel
                WHERE heureAppel < '08:00:00'  OR heureAppel > '18:00:00' and typeConnexion like '%3G%'
                GROUP BY numAbonné
                ORDER BY cast(duréeAppelFact AS DECIMAL(10,3) ) /*COLLATE utf8_unicode_ci */DESC
                LIMIT 10";
        $result = $this->mysqli_query($conn, $sql);
                if($result) {
                    while($row = $result->fetch_assoc())
                    {
                        $rows[] = $row;
                    }
                    return $rows;
                }
                return null;
    }
    //quantité totale de SMS envoyés par l'ensemble des abonnés
     function getTotalSms(){

        $smsString =new String('%envoi de sms%');
        $sql = "SELECT COUNT(*) AS totalsms FROM appel WHERE typeConnexion like $smsString ";
        $result = $this->mysqli_query($conn, $sql);
        if($result) {
            $resut = $resut->fetch_array();
            return $resut['totalsms'];
        }
        return 0;
    }
  function hideShow($bt){
      $identif=$bt.id;
      switch ($identif) {
          case 'btn_durée':
            $el=getElementById('duréeTotRéelAppel').style.display;
            if($el == 'none'){
              $el = block;
            }else{
              $el = none;
            };
              break;

           case 'btn_sms':
            $el=getElementById('totalSms').style.display;
            if($el == 'none'){
              $el = block;
            }else{
              $el = none;
            };
            break;
            
            case 'btn_volume':
                $el=getElementById('topAboVolumData').style.display;
              if($el == 'none'){
                $el = block;
              }else{
               $el = none;
              };
                break;   
          
          default:
              # code...
              break;
      }
  }
  
?>