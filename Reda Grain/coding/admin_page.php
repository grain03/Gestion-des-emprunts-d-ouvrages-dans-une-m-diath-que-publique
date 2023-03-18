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
                <li class="active"><a  href="#">Profil</a></li>
                <li class='btn'><a  href="categories"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <li class='btn'><a  href="#"><i class="fa-solid fa-bag-shopping"></i></a><span class='counter'><h4>0</h4></span></li>
            </ul>
        </div>
    </nav>
    <main>
        <form class='search'>
            <div class="search_input">
                <input type="text" value='@username'>
            </div>
            <div class="filter">
                <input type="checkbox" value="borrowings">
                <label for="email">BORROWINGS</label>
                <input type="checkbox" value="reservations">
                <label for="email">RESERVATIONS</label>
            </div>
            <button>SEARCH</button>
        </form>
    </main>



    <section id='pubs'>

        <div class='main_cards'>
            <div class='cards'>
                <div class="card">
                    <div class="cover">
                        <img src="covers/411ZXwcQ8vL._SX331_BO1,204,203,200_.jpg">
                    </div>
                    <div class="cardcontent">
                        <h1>22$/day</h1>
                        <h3>How to Talk to Anybody</h3>
                        <h5>Reservation Date: 10/12/2022</h5>
                    </div>
                    <form>
                        <button href='#'>BORROW</button>
                    </form>
                </div>
                <div class="card">
                    <div class="cover">
                        <img src="covers/411ZXwcQ8vL._SX331_BO1,204,203,200_.jpg">
                    </div>                    
                    <div class="cardcontent">
                        <h1>22$/day</h1>
                        <h3>Public Speaking How To Speak Effectively Without Fear</h3>
                        <h5>Borrow Date: 10/12/2022</h5>
                    </div>
                    <form>
                        <button href='#'>RECORD RETURN</button>
                    </form>
                </div>
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
        width: 100%;
    }
    .search{
        width: 80%;
        display: grid;
        justify-content: center;
        margin: 50px auto;
    }.search_input input{
        background: transparent;
        border: 2px solid #815B5B;
        border-radius: 10px;
        padding: 10px 100px;
        color: #815B5B;
        margin: 5px; 
    }.filter{
        margin: 10px auto;
        color: #815B5B;
    }.filter input{
        margin-left: 20px;
        color: #815B5B;
    }
    ::-webkit-input-placeholder {
        color: #815B5B;
    }
    .search button{
        background: #815B5B;
        padding: 10px;
        width: 280px;
        border:none;
        margin: 5px auto;
        text-transform: uppercase;
        border-radius: 5px;
        color: #fff;
        font-size: 0.6em;
        font-weight: 600;
        cursor: pointer;
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
    }.cards button{
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
    a{
        margin: 5px 0;
        font-size: 0.8em;
        color: #A1A1A1;
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
        font-size: 0.6em;
        font-weight: 500;
    }

</style>