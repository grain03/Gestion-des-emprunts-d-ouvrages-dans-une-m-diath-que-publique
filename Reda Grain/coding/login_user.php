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
                <li class="active"><a  href="signup.php">SIGN UP</a></li>
            </ul>
        </div>
    </nav>
    <main>
    <?php 
            session_start();
            include("./config/db.php");

            if(isset($_COOKIE['username'])) { echo $_COOKIE['username'];}

                if(isset($_POST['btn'])){
                    $username = $_POST['username'];
                    $sql_check = "SELECT user_id, f_name, l_name, email, password FROM user WHERE username = '$username'";
                    $sqlresponse = $db->prepare($sql_check);
                    $sqlresponse->execute();
                    $sqlresult = $sqlresponse->fetch( PDO::FETCH_ASSOC );
                    $count = $sqlresponse->rowCount();

                    $password = $_POST['password'];
                    $HASHEDpassword = $sqlresult['password'];

                    if($count == 0){
                        echo $error_msg = 'There is no user with this username!';
                    }elseif(!password_verify($password, $HASHEDpassword)) {
                        echo $error_msg = 'Password is not valid!';
                    }else{
                        session_start();
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['password'] = $_POST['password'];
                        $_SESSION['user_id'] = $sqlresult['user_id'];
                        $_SESSION['username'] = $sqlresult['username'];
                        header('Location: profile.php');
                    }
                
        }
        ?>

        
        <div class="content">
            <div class='content_text'>
                <h3>Welcome back to<br><span>MEDIA LIB</span></h3>
                <p>Log in with your account.<br> You don't have an account yet? <a href='signup.php'>You can create an account now for free!</a></p>
            </div>
            <form class='login' method='post'>
                <label for="username">Username</label>
                <input id='username' name='username' type="text" value="<?=$_SESSION['username']?>">
                <label for="password">Password</label>
                <input id='password' name='password' type="password" value="<?=$_SESSION['password']?>">   
                <button name='btn'>LOG IN</button>
            </form>

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
    .content{
        width: 40%;
        margin: 50px auto;
        background: #fff;
        border-radius: 10px;
        display: grid;
        justify-content: center;
        padding: 50px;
    }
    .content_text{
        padding: 10px;
    }
    .content_text h3{
        font-size: 0.7em;
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