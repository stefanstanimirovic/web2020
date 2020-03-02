<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p style="color: blue">
        <?php 
            echo "Hello world!<br>";  
            print("Hello world sa print funkcijom<br>"); 
            echo 'Zdravo svete!<br>'; 
            echo 'Zdravo "svete"!<br>';
            echo "Zdravo 'svete'!<br>";
            echo 5.6;
            echo "<br>";
            echo -3;
            echo "<br>";
            echo true; // 1
            echo "<br>";
            echo false; // nista
            echo "<br>";
            var_dump(true);
            var_dump(false); // za testiranje
        ?>
        <?php 
            // Izmedju PHP tagova ide PHP kod
            /* Komentar u 
                vise redova */
        ?>
        <!-- Komentar u HTML-u -->
        <?php
            $x = 5;
            $y = "Ponedeljak";
            $x = true;
            $x = 4.4;
            echo $x, $y; 
        ?>
    </p>
    <h2>
        <?php 
            // Globalne prom. - van funkcije
            // Lokalne prom. - unutar f-je
            echo "Naslov velicine 2"; 
            echo $x;

            function zbir($a, $b) 
            {
                $z = $a + $b;
                return $z;
            }

            echo "<br>", $x, "<br>", zbir(4, 5), "<br>";
        
            $x = 5;
            if($x == "5") 
            {
                echo "x je jednako 5<br>";
            }
            if($x === "5") 
            {
                echo "x je === 5<br>";
            }
            /*
                = - dodela vrednosti
                == - ispitivanje jednakosti po vrednosti
                === - ispitivanje jednakosti po tipu i vrednosti
            */
            $x = 12;
            echo 'Vrednost promenljive x je: $x <br>';
            echo "Vrednost promenljive x je: $x <br>";
            echo "Razdaljina je ${x}cm<br>";
        ?>

    </h2>

    <?php
        // Nizovi
        $x = [5, -7.7, 2, 8];
        $y = array(6, -8, 0.5, "Pera", false, $x);
        $x[0] = 16;
        $x[100] = -4;
        $x[12] = 8;
        var_dump($x);
        var_dump($y);

        // Asocijativni niz
        // Element = kljuc/vrednost
        $z = array(
            "Pera" => 184,
            "Mika" => 190,
            "Laza" => 195,
        );
        var_dump($z);
        var_dump($z["Pera"]);
        $z["Pera"] = false;
        var_dump($z);

        // Iteracija kroz nizove
        for($i = 0; $i < count($y) - 1; $i++) 
        {
            echo "<p>", $y[$i], "</p>";
        }

        /*
        for($i = 0; $i < count($x); $i++) 
        {
            echo "<p>", $x[$i], "</p>";
        }
        */
        foreach($x as $key => $value) 
        {
            echo "<p>", $value, "</p>";
        }
    ?>
</body>
</html>
