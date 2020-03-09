<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $niz = [];
        $niz[] = 6;
        $niz[] = -8;
        $niz[] = 4.823;
        $niz[5] = 7;
        var_dump($niz);

        $asocijativni = [];
        $asocijativni["Pera"] = 189;
        $asocijativni["Mika"] = 171;
        $asocijativni["Ana"] = 168;
        var_dump($asocijativni);

        // count($niz) = 4
        /*
        for($i = 0; $i < count($niz); $i++)
        {
            // $niz[0], $niz[1], $niz[2], $niz[3]
            echo "<p>$niz[$i]</p>";
        }
        */
        foreach($niz as $value) 
        {
            echo "<p>$value</p>";
        }
        foreach($niz as $key => $value)
        {
            echo "<p>($key, $value)</p>";
        }
        foreach($asocijativni as $key => $value)
        {
            echo "<p>($key, $value)</p>";
        }

        // Ispisati dužinu svakog elementa u nizu stringova.
        $nizStringova = 
            ["Milan", "Aleksandar", "Jovana", "Ana", "Julijana", "Dzon"];
        foreach($nizStringova as $str) 
        {
            $l = strlen($str);
            echo "<p>$l</p>";
        }

        // Odrediti element u nizu stringova sa najvećom dužinom.
        $najDuzina = strlen($nizStringova[0]);
        $index = 0;
        for($i = 1; $i < count($nizStringova); $i++)
        {
            if(strlen($nizStringova[$i]) > $najDuzina)
            {
                $najDuzina = strlen($nizStringova[$i]);
                $index = $i;
            }
        }
        echo "<p>Element sa najvecom duzinom je: 
                $nizStringova[$index]</p>";

        // Odrediti broj elemenata u nizu stringova koji sadrže slovo 'a'.
        $brojEl = 0;
        foreach($nizStringova as $str)
        {
            // Da li $str sadrzi 'a'
            if(strpos($str, 'a') !== false) 
            {
                $brojEl++;
            }
        }
        echo "<p>Broj pojavljivanja stringa 'a': $brojEl</p>";

        // Odrediti broj elemenata u nizu stringova koji počinju na slovo 'a' ili 'A'.
        // if(strpos($str, 'a') === 0)

        $brojA = 0;
        foreach($nizStringova as $str) 
        {
            // substr($str, $poc, $duz)
            // substr("Ponedeljak", 1, 4) => "oned"
            // substr("Ponedeljak", 0, 5) => "Poned"
            if(substr($str, 0, 1) === "a" || 
                substr($str, 0, 1) === "A")
            {
                $brojA++;
            }
        }
        echo "<p>Broj elemenata koji pocinju na 'A' ili 'a': $brojA</p>";

        // Na osnovu celobrojnog niza $a[0], $a[1], … formirati niz $b[0], $b[1], ... koji sadrži samo pozitivne brojeve.
        $a = [7, -6, 4, 3, 3, -3, 0, -2, 1, 5];
        $b = [];
        foreach($a as $elem)
        {
            if($elem > 0)
            {
                $b[] = $elem;
            }
        }
        var_dump($b);

        /*
        Dat je niz elemenata u obliku MarkaAuta/Godište.
        Ispisati sve automobile, kao i njihova godišta.
        Ispisati automobile koji su stariji od 10 godina.
        Ispisati automobile čija Marka sarži string “Opel”, a proizvedena su posle 2000. godine.
        */
        $automobili = [
            "Opel Corsa" => 2004,
            "Peugeot 208" => 2019,
            "Opel Astra" => 1999,
            "Audi A3" => 1995,
            "Mazda CX3" => 2012,
        ];
        foreach($automobili as $auto => $godiste) 
        {
            echo "<p>$auto proizveden $godiste. godine</p>";
        }
        foreach($automobili as $auto => $godiste)
        {
            if(date("Y") - $godiste > 10)
            {
                echo "<p>$auto proizveden $godiste. godine je stariji od 10 godina</p>";
            }
        }
        foreach($automobili as $auto => $godiste)
        {
            if(strpos($auto, "Opel") !== false
                && $godiste > 2000)
            {
                echo "<p>$auto($godiste) je proizveden posle 2000. godine</p>";
            }
        }
    ?>
</body>
</html>