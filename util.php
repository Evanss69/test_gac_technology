<?php
  // Connect to database
  include("db_connect.php");
  class Util{
    public function getDuréeTotaleReelAppel()
	{
        $date=new String('2012-02-15');
        $sql = "SELECT  SUM( TIME_TO_SEC(duréeAppelRéel )  ) AS totalDuréeRéelleAppel FROM AppelTéléphonique WHERE typeConnexion like '%appel%'  AND dateAppel >= '".$date."'";
        $result = $this->mysqli_query($conn, $sql);
        if($result) {
            $result = $result->fetch_array();
            return $result['totalDuréeRéelleAppel'];
        }
        return "00:00:00";
	}
    // TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné.

    public function getTop10VolumesDataFacturésHorsService()
    {
        $sql = "SELECT  id, compteFact, numFact, numAbonné, dateAppel, heureAppel, duréeAppelRéel ,duréeAppelFact, typeConnexion
                FROM AppelTéléphonique
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
    public function getTotalSms(){

        $smsString =new String('%envoi de sms%');
        $sql = "SELECT COUNT(*) AS totalsms FROM AppelTéléphonique WHERE typeConnexion like $smsString ";
        $result = $this->mysqli_query($conn, $sql);
        if($result) {
            $resut = $resut->fetch_array();
            return $resut['totalsms'];
        }
        return 0;
    }
  }
  
?>