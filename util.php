<?php
     function getDuréeTotaleReelAppel()
	{
        include("db_connect.php");
        $date='2012-02-15';
        $sql = "SELECT  SUM( TIME_TO_SEC(duréeAppelRéel )  ) AS totalDuréeRéelleAppel FROM appel WHERE typeConnexion like '%appel%'  AND dateAppel >= '".$date."'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $result = $result->fetch_array();
            return duree($result['totalDuréeRéelleAppel']);
        }
        return "00:00:00";
	}
    // TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné.

     function getTop10VolumesDataFacturésHorsService()
    {
        include("db_connect.php");
        $sql = "SELECT numAbonné,duréeAppelFact
                FROM appel
                WHERE heureAppel < '08:00:00'  OR heureAppel > '18:00:00' and typeConnexion like '%3G%'
                GROUP BY numAbonné
                ORDER BY cast(duréeAppelFact AS DECIMAL(10,3) ) /*COLLATE utf8_unicode_ci */DESC
                LIMIT 10";
        $result = mysqli_query($conn, $sql);
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
        include("db_connect.php");
        $sql = "SELECT COUNT(*) AS totalsms FROM appel WHERE  typeConnexion like '%envoi de sms%'";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $count = mysqli_fetch_assoc($result);
            return $count['totalsms'];
        }
        return 0;
    } 
    function duree($time) {
        $tabTemps = array("annee" => 31536000,
        "mois" =>  2628000,   
        "jours" => 86400,
        "heures" => 3600,
        "minutes" => 60,
        "secondes" => 1);
        $result = "";

        foreach($tabTemps as $uniteTemps => $nombreSecondesDansUnite) {
            $$uniteTemps = floor($time/$nombreSecondesDansUnite);
            $time = $time%$nombreSecondesDansUnite;
            if($$uniteTemps > 0 || !empty($result))
            $result .= $$uniteTemps." $uniteTemps ";
        }
        return $result;
}
?>