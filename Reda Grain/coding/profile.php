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
    <title>HOME</title>
</head>
<body>
    <nav>
        <div class="logo">
            <h1>MEDIA LIB</h1>
        </div>
        <div class='menu' >
            <ul>
                <li><a href="./home.php">Home</li>
                <li class="active"><a  href="logout.php">LOG out</a></li>
                <li class='btn'><a  href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <li class='btn'><a  href="#reservations"><i class="fa-solid fa-bag-shopping"></i></a><span class='counter'><h4><?=$_SESSION['counter']?></h4></span></li>
            </ul>
        </div>
    </nav>
<?php 
include("./config/db.php");


    $user_id = $_SESSION['user_id'];
    $get_user_data = "SELECT user.* from user where user_id = '$user_id'";
    $send_request = $db->prepare($get_user_data);
    $send_request ->execute();
    $user_data = $send_request->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['f_name'] = $user_data[0]['f_name'];
    $_SESSION['l_name'] = $user_data[0]['l_name'];
    $_SESSION['adress'] = $user_data[0]['adress'];
    $_SESSION['phone_number'] = $user_data[0]['tel'];
    $_SESSION['cin'] = $user_data[0]['cin'];
    $_SESSION['password'] = $user_data[0]['password'];
    $_SESSION['date_of_birth'] = $user_data[0]['date_of_birth'];
    $_SESSION['type'] = $user_data[0]['user_type'];




?>
    <main>
        <div class='title'>
            <h1>MY PROFILE</h1>
        </div>
        <div class="profile">
            <div class='profile_header'>
                <span><?=$user_data[0]['penalite']?> Penalties</span>
                <a href="modify_profile.php"><i class="fa-solid fa-pen"></i></a>
            </div>
            <div class="profile_info">
                <img src="./avatars/2.png" alt="profile image">
                <div class="info-content">
                    <h1><?=$user_data[0]['l_name'] .' '. $user_data[0]['f_name']?></h1>
                    <h6><?= '@'.$user_data[0]['username']?></h6>
                    <h2>Email: <span><?=$user_data[0]['email']?></span></h2>
                    <h2>Phone number: <span>+212 <?=$user_data[0]['tel']?></span></h2>
                    <h2>Adress: <span><?=$user_data[0]['adress']?></span></h2>
                </div>
            </div>            
        </div>
        <div class="reservations" id="reservations">
            <div class='reservation_title'>
                <h1>MY RESERVATIONS</h1>
                
            </div>
            <div class="cards">
                    <?php
                    $get_user_reservations = "SELECT reservations.* , books.* from reservations inner join books on books.book_id = reservations.book_id where user_id = '$user_id'";
                    $send_request = $db->prepare($get_user_reservations);
                    $send_request ->execute();
                    $reservations = $send_request->fetchAll(PDO::FETCH_ASSOC);
                    $cards = $send_request->rowCount();
                    if($cards == 0){
                        echo "<h3>No reservation at this moment!</h3>";
                    }
                    

                    for($i = 0; $i < $cards; $i++){
                        echo "
                            <div class='card'>
                                <div class='cover'>
                                    <img src='".'covers/'.$reservations[$i]['cover_image']."'>
                                </div>
                                <div class='cardcontent'>
                                    <h1>".$reservations[$i]['prix']."$/day</h1>
                                    <h3>".$reservations[$i]['book_name']."</h3>
                                    <h5>Reserved at: ".$reservations[$i]['reservation_date']."</h5>
                                </div>
                                <form class='detail' action='details.php' method='get'>
                                    <button name='id' value='".$reservations[$i]['book_id']."'>More Details</button>
                                </form>
                                <form class='cancel' action='cancel.php' method='get'>
                                    <button name='id' value='".$reservations[$i]['book_id']."'>Cancel</button>
                                </form>   
                            </div>";
                    }
                
                ?>

            </div>
        </div>


        <div class="borrowings">
            <div class='borrowings_title'>
                <h1>MY BORROWINGS</h1>
            </div>
            <div class="cards">
                <div class="card">
                    <div class="cover">
                        <img src="covers/411ZXwcQ8vL._SX331_BO1,204,203,200_.jpg">
                    </div>
                    <div class="cardcontent">
                        <h1>22$/day</h1>
                        <h3>How to Talk to Anybody</h3>
                        <h5>Published: 10/12/2022</h5>
                    </div>
                    <form class='detail'>
                        <button href='#'>More Details</button>
                    </form>                    
                </div>
            </div>
        </div>


    </main>





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
        background: #E6E6E6;
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
    .title h1{
        margin: 50px;
        text-align: center;
        color:#815B5B ;
        font-size: 1.5em;
        text-decoration: underline;
    }
    main{
        width: 100%; 
        display: grid;       
    }
    h3{
        display: flex;
        justify-content: center;
        width: 100%;
        margin: 0 auto;
        color: #a8a8a8;
        font-weight: 500;   
        font-size: 0.7em;

    }
    .profile{
        width: 40%;
        margin: 20px auto;
        background: #fff;
        border-radius: 10px;
        padding: 25px;
    }
    .profile_header{
        display: flex;
        justify-content: space-between;
        width: 100%;
    }
    .profile_header span{
        padding: 8px;
        background: #D78C57;
        border-radius: 10px;
        font-size: 0.7em;
        color: #fff;
    }
    .profile_info{
        width: 100%;
        display: grid;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .profile_info img{
        display: flex;
        align-items: center;
        width: 70px;
        margin: auto;
        justify-content: center;
    }
    .info-content{
        margin: 10px;
    }
    .info-content h1{
        font-size: 1.3em;
        margin: 3px;
    }
    .info-content h6{
        font-size: 0.8em;
        font-weight: 500;
        color: #A1A1A1;
        margin: 5px;
    }.info-content h2{
        font-size: 0.9em;
        margin: 5px;

    }.info-content span{
        font-size: 0.9em;
        font-weight: 500;
        margin: 5px;

    }




    .reservations{
        width: 40%;
        margin: 20px auto;
        background: #815B5B;
        border-radius: 10px;
        padding: 25px;
    }.borrowings{
        width: 40%;
        margin: 20px auto;
        background: #fff;
        border-radius: 10px;
        padding: 25px;
    }

    .reservation_title h1{
        margin: 10px;
        text-align: center;
        color:#fff ;
        font-size: 1.3em;
    }
    .borrowings_title h1 {
        margin: 10px;
        text-align: center;
        color:#815B5B ;
        font-size: 1.3em;
    }
    .reservations .cards{
        display: flex;
        flex-wrap: wrap;
    }
    .reservations .card{
        width: 40%;
        min-height: 300px;
        background: #fff;
        margin: 15px;
        padding: 5px;
        border-radius: 15px;
    }
    .borrowings .card{
        width: 40%;
        min-height: 300px;
        background: #FFF8EA;
        margin: 15px;
        padding: 5px;
        border-radius: 15px;
    }
    .cards .cover{
        margin: 5px auto;
        width: 100px;
    }
    .cards .cover img{
        width: 100%;
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
    }.detail button{
        width: 100%;
        margin: 3px auto;
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
    .cancel button{
        width: 100%;
        margin: 3px auto;
        background: transparent;
        padding: 10px 50px;
        border: 2px solid #815B5B;
        text-transform: uppercase;
        border-radius: 5px;
        color: #815B5B;
        font-size: 0.6em;
        font-weight: 600;
        cursor: pointer;
    }




    .content_text h4{
        font-size: 0.7em;
        margin: 4px;

    }.content_text span{
        font-size: 1.9em;
    }.content_text p, a{
        margin: 5px 0;
        font-size: 0.8em;
        color: #A1A1A1;
    }.login label{
        font-size: 0.8em;
        margin:4px ;
        font-weight: 500;

    }
    .login{
        display: grid;
        justify-content: start;
    }.login input{
        background: transparent;
        border: 2px solid #815B5B;
        border-radius: 8px;
        padding: 5px;
        width: 500px;
        color: #815B5B;
        margin: 3px; 
    }.login select{
        background: transparent;
        border: 2px solid #815B5B;
        border-radius: 8px;
        padding: 5px;
        width: 513px;
        color: #815B5B;
        margin: 3px; 
    }
    .login button{
        background: #815B5B;
        padding: 10px 40px;
        border:none;
        margin: 5px;
        text-transform: uppercase;
        border-radius: 5px;
        color: #fff;
        font-size: 0.7em;
        font-weight: 600;
        cursor: pointer;
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

    .sideright{
        color: #fff;
        margin: 30px 80px;
        display: flex;
        align-items: flex-end;
    }.sideright h5{
        font-size: 0.7em;
        font-weight: 500;
    }

</style>