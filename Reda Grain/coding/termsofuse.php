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
                <li><a href="#categories">CATERGORIES</a></li>
                <li><a href="#pubs">TOP PUBLICATIONS</li>
                <li class="active"><a  href="#">Profil</a></li>
                <li class='btn'><a  href="categories"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <li class='btn'><a  href="#"><i class="fa-solid fa-bag-shopping"></i></a><span class='counter'><h4>0</h4></span></li>
            </ul>
        </div>
    </nav>



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