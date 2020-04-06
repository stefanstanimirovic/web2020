<?php
    require_once 'header.php';
    if(!$loggedin) 
    {
        // Stranici pristupa nelogovan korisnik, i vrsi se restrikcija
        // header('Location: login.php');
        die("<h3>You must <a href='login.php'>login</a> first to see the content of this page.</h3></div></body></html>");
    }

    $fname = $lname = $email = $gender = $lang = $bio = "";
    $fnameError = $lnameError = $emailError = $genderError = $langError = "";

    $result = queryMysql("SELECT * FROM profiles WHERE user_id = $id");
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $lang = $row['language'];
        $bio = $row['bio'];
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(!empty($_POST['fname']))
        {
            $fname = sanitizeString($_POST['fname']);
        }
        else
        {
            $fnameError = "First name cannot be left blank.";
        }
        if(!empty($_POST['lname']))
        {
            $lname = sanitizeString($_POST['lname']);
        }
        else
        {
            $lnameError = "Last name cannot be left blank.";
        }
        if(empty($_POST['email'])) // Da li je vrednost elementa prazna?
        {
            $emailError = "Email field cannot be left blank.";
        }
        else 
        {
            $email = sanitizeString($_POST['email']);
            // check if e-mail adress is well-formed
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $emailError = "Invalid email format.";
                $email = "";
            }
        }
        if(isset($_POST['gender'])) // Da li postoji element sa zadatim kljucem?
        {
            $gender = sanitizeString($_POST['gender']);
        }
        else 
        {
            $genderError = "Gender cannot be left blank.";
        }
        if(!empty($_POST['lang']))
        {
            $lang = sanitizeString($_POST['lang']);
        }
        else 
        {
            $langError = "You mush choose one language.";
        }
        $bio = sanitizeString($_POST['bio']);
        $bio = preg_replace('/\s\s+/', ' ', $bio);
        
        // Upis u bazu tek ako nije doslo do greske
        if($fnameError == "" && $lnameError == "" && $emailError == ""
            && $genderError == "" && $langError == "")
        {
            if($result->num_rows > 0)
            {
                // Profil vec postoji, vrsi update
                queryMysql("UPDATE profiles
                    SET first_name = '$fname',
                        last_name = '$lname',
                        email = '$email',
                        gender = '$gender',
                        language = '$lang',
                        bio = '$bio'
                    WHERE user_id = $id");
            }
            else
            {
                queryMysql("INSERT INTO profiles(user_id, first_name, last_name, email, gender, language, bio)
                    VALUE ($id, '$fname', '$lname', '$email', '$gender', '$lang', '$bio');
                ");
            }
        }
    }
?>

    <div class="content">
        <!-- Sadrzaj stranice profile.php -->
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Add or edit your profile</h2>
            <span class="error">* requred fields</span><br><br>

            <label for="fname">First name:</label>
            <input type="text" name="fname" id="fname" value="<?php echo $fname ?>">
            <span class="error">* <?php echo $fnameError ?></span>
            <br>
            <label for="lname">Last name:</label>
            <input type="text" name="lname" id="lname" value="<?php echo $lname ?>">
            <span class="error">* <?php echo $lnameError ?></span>
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email ?>">
            <span class="error">* <?php echo $emailError ?></span>
            <br>
            <label for="gender">Gender:</label>
            <input type="radio" name="gender" id="female" value="female"
                <?php echo ($gender == 'female') ? "checked" : "" ?>> Female
            <input type="radio" name="gender" id="male" value="male"
                <?php echo ($gender == 'male') ? "checked" : "" ?>> Male
            <span class="error">* <?php echo $genderError ?></span>
            <br>
            <label for="lang">Favourite programming language:</label>
            <select name="lang" id="lang">
                <option value="" <?php echo ($lang == "") ? "selected" : "" ?>>--Choose--</option>
                <option value="php" <?php echo ($lang == "php") ? "selected" : "" ?>>Php</option>
                <option value="c" <?php echo ($lang == "c") ? "selected" : "" ?>>C</option>
                <option value="c++" <?php echo ($lang == "c++") ? "selected" : "" ?>>C++</option>
                <option value="java" <?php echo ($lang == "java") ? "selected" : "" ?>>Java</option>
            </select>
            <span class="error">* <?php echo $langError ?></span>
            <br>
            <label for="bio">Biography:</label>
            <textarea name="bio" id="bio" cols="30" rows="4"><?php echo $bio?></textarea>
            <br>
            <label for="image">Profile photo:</label>
            <input type="file" name="image" id="image">
            <br>
            <input type="submit" value="Save Profile">
        </form>
    </div>

</div>
</body>
</html>