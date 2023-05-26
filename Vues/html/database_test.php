<?php 
    function getData(){
        include_once("C:/Users/imadr/OneDrive/Documents/ISEP/Projet_syst_num/informatique/xampp/htdocs/take-eir-app/Models/infoDB.php");
        $conn = connectionToDB();
        $sql = "
        SELECT * FROM sensors_data sd ORDER BY sd.measure_date 
                ";

        $commande = $conn->prepare($sql);
        $bool = $commande->execute();

        $resultat = $commande->fetchAll(PDO::FETCH_ASSOC); //tableau d'enregistrements
        return $resultat;

    }
    
    $data = getData();

    function fromDataToString($datam, $key){
        $result =  '[';
        $columnValue = array_column($datam, $key);
        for ($i=0; $i < count($datam)-1; $i++){
            $result = $result . '"' . strval($columnValue[$i]). '", ';
        }
        $result = $result . '"'. strval($columnValue[count($datam)-1]). '"]';
        return $result;
    }

    $date = fromDataToString($data, "measure_date");
    $heart = fromDataToString($data, "heart_rate");
    $temp = fromDataToString($data, "temp_rate");
    $noise = fromDataToString($data, "noise_rate");
    $co2 = fromDataToString($data, "co2_rate");
    $dust = fromDataToString($data, "dust_rate");
?>