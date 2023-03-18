<?php session_start();
include("./config/db.php");
if(!isset($_SESSION['user_id'])){
    header('Location: login_user.php');
    die;
}
#error_reporting(E_ERROR | E_PARSE);
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
                <li class="active"><a  href="login_user.php">LOG IN</a></li>
                <li class='btn'><a  href="categories"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <li class='btn'><a  href="#"><i class="fa-solid fa-bag-shopping"></i></a><span class='counter'><h4>0</h4></span></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="content">
            <div class='content_text'>
                <h3>Welcome to<br><span>MEDIA LIB</span></h3>
                <p>Modify your profile’s informations!</p>
            </div>
            <form class='login' method='post'>
                <label for="lname">Last name</label>
                <input id='lname' name='lname' type="text"  value="<?=$_SESSION['l_name']?>">
                <label for="fname">First name</label>
                <input id='fname' name='fname' type="text" value="<?=$_SESSION['f_name']?>">
                <label for="adress">Adress</label>
                <input id='adress' name='adress' type="textarea" value="<?=$_SESSION['adress']?>">
                <label for="phone_number">Phone number</label>
                <input id='phone_number' name='phone_number' type="number" value="0<?=$_SESSION['phone_number']?>">
                <label for="cin">C.I.N</label>
                <input id='cin' name='cin' type="text" value="<?=$_SESSION['cin']?>">
                <label for="password">Password</label>
                <input id='password' name='password' type="password" value="<?=$_SESSION['password']?>">
                <label for="dateofbirth">Date of Birth</label>
                <input id='dateofbirth' name='dateofbirth' type="date" value="<?=$_SESSION['date_of_birth']?>">
                <label for="type">User Account Type</label>
                <select id='type' name='type'>
                    <option value="default" disabled selected>User Account Type</option>
                    <option value="Employee">Employee</option>
                    <option value="Student">Student</option>
                    <option value="Housewife">Housewife</option>
                    <option value="Civil">Civil</option>
                </select>
                <button>Modify ACCOUNT</button>
            </form>

        </div>
    </main>



        <?php 
        $l_name = $_POST['lname'];
        $f_name = $_POST['fname'];
        $adress = $_POST['adress'];
        $city = $_POST['city'];
        $phone_number = $_POST['phone_number'];
        $cin = $_POST['cin'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $date_of_birth = $_POST['dateofbirth'];
        $type = $_POST['type'];

        $check_if_user_exists = "SELECT user.username, user.email from user";
        $send_request = $db->prepare($check_if_user_exists);
        $send_request ->execute();
        $check = $send_request->fetchAll(PDO::FETCH_ASSOC);
        $users = $send_request->rowCount();


            if(strlen($l_name) > 15 or strlen($l_name) == 0){
                $error_msg = 'Your Last Name must not be empty and over 15 characters!';
            }
            elseif(preg_match_all("/[&<>\|`_@}{()@~'!§£=€]/", $l_name)){
                $error_msg = 'Your Last Name must not contain special characters!';
            }        
            elseif(strlen($f_name) > 15 or strlen($f_name) == 0){
                $error_msg = 'Your First Name must not be empty and over 15 characters!';
            }
            elseif(preg_match_all("/[&<>\|`_@}{()@~'!§£=€]/", $f_name)){
                $error_msg = 'Your First Name must not contain special characters!';
            }

            elseif(preg_match_all("/[&<>\|`_@}{()@~'!§£=€]/", $adress)){
                $error_msg = 'Your Adress must not contain special characters!';
            }
            elseif(strlen($_POST['phone_number']) !== 10){
                $error_msg = 'Your Phone Number must contain 10 numbers!';
            }
            elseif(preg_match_all("/[&<>\|`_@}{()@~'!§£=€]/", $cin) or empty($cin)){
                $error_msg = 'Your C.I.N must not contain special characters or empty!';
            }      
            elseif(strlen($password) > 16 || strlen($password) < 8){
                $error_msg = 'Your Password length must be between 8 and 16 characters!';
            }
            elseif(!preg_match_all("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[&$#!§:;.?+=@]).{8,}$/", $_POST['password'])){
                $error_msg = 'Your Password is not Strong!' ."<br>" . 
                '<ul>
                    <li>Your password must contain Alphabetics</li>
                    <li>Your password must contain Numbers</li>
                    <li>Your password must contain Special characters like (&@_{# ect..)</li>
                </ul>';
            }
            else{
                $date_open_account = date("Y/m/d");
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $Inser_user_data = "UPDATE user SET f_name = '$f_name' ,l_name= '$l_name',adress= '$adress', tel= '$phone_number',cin= '$cin', password= '$password', user_type= '$type', date_of_birth= '$date_of_birth'";
                $send_data = $db->prepare($Inser_user_data);
                $send_data->execute();
                header('Location: login_user.php');
                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['username'] = $_POST['username'];
            }   
        


        ?>


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