<?php 
            try{
              $db = new PDO("mysql:host=localhost;dbname=media_lib;charset=utf8mb4;", 'root', ''); 
                           
            }
            catch(PDOException $e){
              echo 'Erreur : ' . $e->getMessage();
            }
            // refrech page every 10 seconds
            $sec = "10";
            header("Refresh: $sec");
    ?>
