<?php               include("./config/db.php");

                    $response = $db->prepare($get_cards);
                    $response->execute();
                    $cards = $response->rowCount();
                    $card = $response->fetchAll(PDO::FETCH_ASSOC);

?>