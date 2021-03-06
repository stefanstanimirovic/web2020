<?php 
    require_once "header.php";
    // Kojom metodom (nacinom) smo dosli na ovu stranicu signup.php?
    // GET ili POST
    // lokalne promenljive - unutar funkcije ($x)
    // globalne promenljive - van funkcije ($x)
    // superglobalne promenljive ($_COOKIE, $_FILES, $_GET, $_POST, $_SERVER)
    //var_dump($_SERVER);
    $error = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);
        if($username == "" || $password == "") {
            $error = "All fields are required!";
        }
        else {
            $result = queryMysql("SELECT * FROM users WHERE username = '$username'");
            // $result - rezultat izvrsenja upita
            if($result->num_rows > 0) {
                // Korisnik sa ovim usernamemom vec postoji!
                $error = "That username is taken - please choose another one!";
            }
            else {
                // Upis novog korisnika
                $codedPassword = PASSWORD_HASH($password, PASSWORD_DEFAULT);
                queryMysql("INSERT INTO users(username, password) 
                    VALUES('$username', '$codedPassword')");
                header("Location: login.php");
            }
        }
    }
    /*
    else {
        if(!empty($_GET['username']) && !empty($_GET['password'])) {
            $username = $connection->real_escape_string($_GET['username']);
            $password = $connection->real_escape_string($_GET['password']);
            echo $username;
            echo "<br>";
            echo $password;
        }
    }
    */
?>
    <div class="content">
        <h2>Create a new account</h2>
        <div class="error">
            <?php echo $error; ?>
        </div>
        <div id="info">
        </div>
        <form action="signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" 
                placeholder="Your username..."
                onBlur="checkUser(this)">
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Your password...">
            <br>
            <input type="submit" value="Sign up!">
        </form>
    </div>
</div>
<script src="myscript.js"></script>
<script>
    function checkUser(inp)
    {
        var username = inp.value;
        if(username == '') {
            document.getElementById('info').innerHTML = "";
            return;
        }

        // AJAX request
        var params = "username=" + username;
        var request = ajaxRequest();
        if(request !== false) {
            request.open("POST", "checkuser.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.setRequestHeader("Content-length", params.length);
            request.setRequestHeader("Connection", "close");

            request.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200)
                {
                    document.getElementById('info').innerHTML = this.responseText;
                }
            }

            request.send(params);
        }
    }
</script>
</body>
</html>