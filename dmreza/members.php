<?php
    require_once 'header.php';
    if(!$loggedin) 
    {
        // Stranici pristupa nelogovan korisnik, i vrsi se restrikcija
        // header('Location: login.php');
        die("<h3>You must <a href='login.php'>login</a> first to see the content of this page.</h3></div></body></html>");
    }
    if(isset($_GET['id']))
    {
        // Prikazi profil korisnika ciji je id = $_GET['id']
        $userId = sanitizeString($_GET['id']);
        $result1 = queryMysql("SELECT first_name, last_name 
                                FROM profiles WHERE user_id = $userId");
        if($result1->num_rows) 
        {
            $row = $result1->fetch_assoc();
            $view = $row['first_name'] . " " . $row['last_name'];
        }
        else 
        {
            $result2 = queryMysql("SELECT username FROM users WHERE id = $userId");
            $row = $result2->fetch_assoc();
            $view = $row['username'];
        }

        if($userId == $id)
        {
            $name = "Your";
        }
        else 
        {
            $name = "${view}'s";
        }

        echo "<h3>$name Profile:</h3>";

        showProfile($userId);
        die("</div></body></html>");
    }
?>

    <div class="content">
        <h3>Members on the platform:</h3>

        <?php
            // Dohvatamo sve korisnike koji nisu logovani korisnik
            $result = queryMysql("SELECT users.id AS uid, users.username,
                profiles.first_name, profiles.last_name
                FROM users
                LEFT JOIN profiles ON users.id = profiles.user_id
                WHERE users.id != $id
                ORDER BY profiles.first_name, profiles.last_name");
            echo "<ul>";
            while($row = $result->fetch_assoc())
            {
                echo "<li>";
                $userId = $row['uid'];
                echo "<a href='members.php?id=$userId'>";
                echo $row['first_name'];
                echo " ";
                echo $row['last_name'];
                echo " (";
                echo $row['username'];
                echo ")";
                echo "</a>";
                echo "</li>";
            }
            echo "</ul>";
        ?>

    </div>


</div>
</body>
</html>