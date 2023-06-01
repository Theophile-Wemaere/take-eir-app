<?php 
   // Paramètres de connexion à la base de données
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "take-eir";
   
   // Connexion à la base de données
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   // Vérifier la connexion
   if ($conn->connect_error) {
       die("Erreur de connexion à la base de données : " . $conn->connect_error);
   }
   
   // Récupérer toutes les données de la table
   $query = "
   SELECT metrics_type, entry_time, value FROM metrics
   ";
   $result = $conn->query($query);
   
   // Récupérer les données dans un tableau associatif
   $data = array();
   while ($row = $result->fetch_assoc()) {
       $data[] = $row;
   }
   
   //$data = json_encode($data);
   //print_r($data);
   // Fermer la connexion à la base de données
   $conn->close();
   
   // Renvoyer les données au format JSON
   echo json_encode($data);

   ?>
   
