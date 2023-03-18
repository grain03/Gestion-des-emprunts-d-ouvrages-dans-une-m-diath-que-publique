<?php session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: login_user.php');
    die;
}
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/29e6f48cb7.js" crossorigin="anonymous"></script>
    <title>DETAILS</title>
</head>
<body>

    <nav>
        <div class="logo">
            <h1>MEDIA LIB</h1>
        </div>
        <div class='menu' >
            <ul>
                <li><a href="./home.php">Home</li>
                <li class="active"><a  href="profile.php">Profil</a></li>
                <li class='btn'><a  href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <li class='btn'><a  href="profile.php#reservations"><i class="fa-solid fa-bag-shopping"></i></a><span class='counter'><h4><?=$_SESSION['counter']?></h4></span></li>
            </ul>
        </div>
    </nav>

    <section class='details'>

        <?php
        
            $id = $_GET['id']; 
            $get_cards = "SELECT * FROM books where book_id = $id";
            include('cards.php');
            echo "
            <div class='card'>
                <div class='cover'>
                    <img src='".'covers/'.$card[0]['cover_image']."'>
                </div>
                <div class='card_content'>
                    <div class='cardcontent'>
                        <h1>".'$'.$card[0]['prix'].'/day'."</h1>
                        <h3>".$card[0]['book_name']."</h3>
                        <h5>Pages: ".$card[0]['pages_number']."</h5>
                        <h5>Autor: ".$card[0]['book_autor']."</h5>
                        <h5>Published: ".$card[0]['publish_date']."</h5>
                    </div>
                    <form method='post'>
                        <div class='check'>
                            <input id='check' name='check' type='checkbox'>
                            <h5>I agree to the terms of use listed below.</h5>
                        </div>
                            <button name='reserve'>RESERVE NOW</button>
                    </form>
                </div>
            </div>";
            $book_id = $card[0]['book_id'];
            $book_name = $card[0]['book_name'];

            
        ?>

        <?php
            // $_SESSION['counter'] = 0;
            $user_id = $_SESSION['user_id'];
            $check_if_reserved = "SELECT * from reservations WHERE book_id = $book_id";
            $response1 = $db->prepare($check_if_reserved);
            $response1->execute();
            $check_count = $response1->rowCount();
            $check = $response1->fetchAll(PDO::FETCH_ASSOC);
            $counter = $_SESSION['counter'];
            if(isset($_POST['reserve'])){
                if($counter == 3){
                    $error_msg = '*You have reached max of reservations!';
                }elseif(!isset($_POST['check'])){
                    $error_msg = '*You should accepte our terms of use listed below before you reserve this publication!';
                }elseif($check_count > 0){
                    $error_msg = '*This Publication is already reserved!';
                }else{
                    date_default_timezone_set("GMT+0");
                    $reservation_date = date("Y/m/d h:i:sa");
                    $expire_time = strtotime("+10 seconds", strtotime($reservation_date));
                    $reserve = "INSERT INTO reservations(user_id, reservation_date, book_id, expire_time) VALUES ($user_id, '$reservation_date', '$book_id', '$expire_time');
                    UPDATE books SET available = 'no' where book_id = '$book_id';";
                    $add_reservation = $db->prepare($reserve);
                    $add_reservation->execute();
                    $msg = 'Reservation is done!';
                    $_SESSION['counter'] += 1;
                    $add_reservation->closeCursor();
                }
            }
        ?>

<?php
         
         $check_if_expired = "SELECT reservation_id, reservation_date, expire_time from reservations where user_id= '$user_id'";
         $response2 = $db->prepare($check_if_expired);
         $response2->execute();
         $expire_count = $response2->rowCount();
         $results = $response2->fetchAll(PDO::FETCH_ASSOC);

         for($i = 0; $i < $expire_count; $i++){
         $reservation_id = $results[$i]['reservation_id'];
         $delete_if_not_exist = "SELECT borrowings.user_id from borrowings where reservation_id = '$reservation_id'";
         $delete_reservation = $db->prepare($delete_if_not_exist);
         $delete_reservation->execute();
         $result = $delete_reservation->rowCount();
         $delete_reservation->closeCursor();
         $current_time = date("Y/m/d h:i:sa");
         $current_time = strtotime($current_time);

         if(($current_time - $results[$i]['expire_time']) > 0 and $result == 0){
             $delete_if_expired = "DELETE FROM reservations where reservation_id = '$reservation_id'; UPDATE books SET available = 'yes' where book_id = $book_id";
             $delete_reservation = $db->prepare($delete_if_expired);
             $delete_reservation->execute();
             $_SESSION['counter'] = bcsub($_SESSION['counter'],1);

         }
     
     }
     ?>

        <div class='error_msg'>
            <h5><?=$error_msg?></h5>
            <h5 style='color: green;'><?=$msg?></h5>
        </div>
    </section>

    <section class='termsofuse'>
        <div class='title'>
            <h1>TERMS OF USE</h1>
        </div>
        <div class='content'>
            <p>Before you borrow a publication, make sure to read these rules below:</p>
            <ul>
                <li>A person cannot borrow or reserve more than three books at the same time.</li>
                <li>A borrowing operation must be preceded by a reservation.</li>
                <li>A torn item cannot be reserved or borrowed.</li>
                <li>A reservation is only made for a book actually available in the library and which is not subject to a current reservation.</li>
                <li>The validity of a reservation is limited to 24 hours.</li>
                <li>The loan period must not exceed 15 days.</li>
                <li>A person who returns a publication beyond 15 days, receives a penalty.</li>
                <li>A person who accumulates more than 3 penalties does not have the right to continue to borrow the books. And his account will be immediately locked.</li>
                <li>No operation will be possible without authentication, even a simple consultation.</li>
            </ul>
        </div>
    </section>
    <footer>
        <div class='sideleft'>
            <h1>MEDIA LIB</h1>
            <ul>
                <li><a href='#'>HOME</a></li>
                <li><a href='#'>CATERGORIES</a></li>
                <li><a href='./termsofuse.php'>TERMS OF USE</a></li>
                <li><a href='#'>LOG OUT</a></li>
            </ul>
        </div>
        <div class="sideright">
            <h5>© COPYRIGHT 2023. <br>All Rights Reserved.</h5>
        </div>
    </footer>
</body>
</html>
<style>
    
    *{
        margin: 0;
        padding: 0;
        font-size: 16px;
        font-family: inter;
        scroll-behavior: smooth;
    }
    body{
        background: #D9C7B7;
    }
    nav{
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #815B5B;
        color: #fff;
    }

    nav .logo{
        margin:30px 50px;
    }
    .logo h1{
        font-size: 1.7em;
    }
    nav .menu ul{
        display: flex;
        align-items: center;
        margin:30px 50px;
        cursor: pointer;
    }
    .menu ul li{
        list-style:none;
        text-decoration: none;
        margin: 3px;
        text-transform: uppercase;
        font-size: 0.9em;
        padding: 5px 8px;
        transition: 0.5s;
        border-bottom: 2px solid transparent;

    }
    .menu ul li:hover:not(.btn, .active){
        border-bottom: 2px solid #fff;
    }
    .menu ul .active{
        background: #D9C7B7;
        border-radius: 15px;
    }

    .menu ul li a{
        color: #fff;
        text-decoration: none;
    }
    .btn{
        padding: 10px;
        position:relative;
    }
    .counter{
        position: absolute;
        background: #d9c7b7;
        border-radius: 40px;
        padding: 2px 5px;
        left: 55%;
        bottom: 3%;
    }
    .counter h4{
        font-size: 0.5em;
    }

    .details{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        justify-content: center;
        margin: 15px auto;
    }
    .error_msg{
        display: grid;
        justify-content: center;
        width: 80%; 
        align-items: center;
        background: #fff;
        margin: 0 15px;
        padding: 10px;
        color: red;
        border-radius: 15px;
    }.error_msg h5{
        width: 70%;
        margin: auto;
        text-align: center;
        font-size: 0.8em;
        font-weight: 500;

    }

    .card{
        display: flex;
        width: 80%;
        min-height: 300px;
        background: #fff;
        margin: 15px;
        padding: 5px;
        border-radius: 15px;
    }
    .card .cover{       
        margin: auto 15px;
        width: 150px;
        
    }
    .card .cover img{
        width: 100%;
    }
    .card_content{
        display: grid;
        margin: 0 22px;
        align-items: center;
    }
    .cardcontent{
        padding: 5px;
        height: 80px;
    }

    .cardcontent h1{
        font-size: 1.3em;
    }.cardcontent h3{
        font-size: 0.8em;
        font-weight: 500;
    }.cardcontent h5{
        font-size: 0.6em;
        font-weight: 500;
        color: #A1A1A1;
        margin:5px 0;
    }
    form{
        display: grid;
    }form .check{
        display: flex;
    }form .check h5{
        font-size: 0.7em;
        font-weight: 400;
        margin: 0 5px;
        color: #A1A1A1;
    }
    button{
        margin: 15px 0;
        background: #815B5B;
        padding: 10px 50px;
        border:none;
        text-transform: uppercase;
        border-radius: 5px;
        color: #fff;
        font-size: 0.6em;
        font-weight: 600;
        cursor: pointer;
    }
    .termsofuse{
        width: 80%;
        min-height: 300px;
        background: #fff;
        margin: 50px auto;
        padding: 50px 5px;
        border-radius: 15px;
    }
    .termsofuse .title{
        text-align: center;
        margin: 10px;
    }.termsofuse .title h1{
        font-size: 1.7em;
        color: #815B5B;
    }
    .termsofuse .content{
        width: 70%;
        margin: 0 auto;
        padding: 20px;
    }.content p{
        font-size: 1.4em;
        font-weight: 800;
    }.content ul{
        width: 70%;
        margin: 50px;
    }.content ul li{
        margin: 8px;
    }
    footer{
        background: #815B5B;
        width: 100%;
        height: 200px;
        border-top-right-radius: 20%;
        display: flex;
        justify-content: space-between;
    }
    .sideleft{
        color: #fff;
        display: grid;
        align-items: center;
        margin: auto 100px;
    }
    .sideleft h1{
        font-size: 1.7em;
    }.sideleft ul{
        list-style: none;
    }.sideleft ul li{
        font-size: 0.7em;
        margin: 10px;
    }.sideleft ul li a{
        color: #fff;
        text-decoration: none;
    }

    a{
        margin: 5px 0;
        font-size: 0.8em;
        color: #A1A1A1;
    }
    .sideright{
        color: #fff;
        margin: 30px 80px;
        display: flex;
        align-items: flex-end;
    }.sideright h5{
        font-size: 0.6em;
        font-weight: 500;
    }
</style>