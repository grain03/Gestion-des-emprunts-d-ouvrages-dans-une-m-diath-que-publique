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
                <li><a href="#categories">CATERGORIES</a></li>
                <li><a href="#pubs">TOP PUBLICATIONS</li>
                <li class="active"><a  href="./profile.php">Profil</a></li>
                <li class='btn'><a  href="search.php"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <li class='btn'><a  href="profile.php#reservations"><i class="fa-solid fa-bag-shopping"></i></a><span class='counter'><h4><?=$_SESSION['counter']?></h4></span></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="content">
            <img src="images/read_image.svg">
            <div class="text">
                <h1>TO SUCCEED YOU MUST READ</h1>
                <h3>We provide you with tons of books including DVDs, CDs, paper books, and more…</h3>
            </div>
        </div>
    </main>


    <section id='categories'>
        <div class='title'>
            <h1>CATERGORIES</h1>
        </div>
        <div class='main_categories'>
            <div class='categories' >
                <div class='category'>
                    <img src="images/cds.png" alt="">
                    <a href='search.php?type=cds'><h5>CDs</h5></a>
                </div>
                <div class='category'>
                    <img src="images/dvd-player.png" alt="">
                    <a href='search.php?type=dvds'><h5>DVDs</h5></a>
                </div>
                <div class='category'>
                    <img src="images/open-book.png" alt="">
                    <a href='search.php?type=books'><h5>Books</h5></a>
                </div>
                <div class='category'>
                    <img src="images/book.png" alt="">
                    <a href='search.php?type=novels'><h5>Novels</h5></a>
                </div>
                <div class='category'>
                    <img src="images/cassette-tape.png" alt="">
                    <a href='search.php?type=cassettes'><h5>Cassettes</h5></a>
                </div>
            </div>
        </div>
    </section>



    <section id='pubs'>
        <div class='title'>
            <h1>TOP PUBLICATIONS</h1>
        </div>
        <div class='main_cards'>
            <div class='cards'>
                <?php 
                
                    $get_cards = "SELECT * FROM books where available = 'yes'";
                    include('cards.php');
                    for($i = 0; $i < $cards; $i++){
                        echo "
                        <div class='card'>
                            <div class='cover'>
                                <img src='".'covers/'.$card[$i]['cover_image']."'>
                            </div>
                            <div class='cardcontent'>
                                <h1>".'$'.$card[$i]['prix'].'/day'."</h1>
                                <h3>".$card[$i]['book_name']."</h3>
                                <h5>Published: ".$card[$i]['publish_date']."</h5>
                            </div>
                            <form action='details.php' method='get'>
                                <button name='id' value='".$card[$i]['book_id']."'>More Details</button>
                            </form>
                        </div>"; 
                    }
                ?>
            </div>
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

    main{
        height: 100vh;
        width: 100%;
        background:#fff;
        border-bottom-left-radius: 40%;
    }
    .content{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    .content img{
        width: 500px;
        margin: 50px 20px 50px 50px;
    }
    .content .text{
        color: #000;
        width: 500px;
        margin: 130px 20px 50px 50px;

    }
    .content .text h1{
        font-size:2.8em;
        width: 300px
    }
    .content .text h3{
        font-size:1em;
        font-weight: 400;
        width: 300px
    }

    section .title{
        margin: 50px;
        text-align: center;
    }section .title h1{
        font-size: 1.7em;
        color: #815B5B;
    }
    .main_categories{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .categories{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        justify-content: center;
    }
    .category{
        width: 15%;
        margin: 5px;
        text-align: center;
        transition: 0.7s;
    }.category:hover{
        transform: scale(1.1);
    }
    .category img{
        width: 50px;
    }.category a{
        text-decoration: none;
    }.category h5{
        color: #815B5B;
        margin: 8px;
    }

    section .cards{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        justify-content: center;
        margin: 20px 0;
    }
    .card{
        width: 15%;
        min-height: 300px;
        background: #fff;
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
    }button{
        display: flex;
        justify-content: center;
        margin: 15px auto 10px;
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
        font-size: 0.8em;
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