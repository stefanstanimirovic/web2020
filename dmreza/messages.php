<?php
require_once 'header.php';
if(!$loggedin)
{
    die("</div></body></html>");
}

$viewId = $id;

$result = queryMysql("SELECT * FROM messages WHERE recip_id=$viewId ORDER BY time DESC");
if($result->num_rows)
{
    echo "<h3>Messages you've received:</h3>";
    while($row = $result->fetch_assoc())
    {
        echo "<div class='message'>";
        //echo date("M jS \'y g:ia:", $row['time']);
        echo date("j.n.Y. H:i:s: ", $row['time']);
        $authId = $row['auth_id'];
        $result1 = queryMysql("SELECT username FROM users WHERE id=$authId");
        $row1 = $result1->fetch_assoc();
        echo $row1['username'];
        if($row['pm'] == '0')
        {
            echo " wrote: <br>&quot;" . $row['message'] . "&quot;";
        }
        else
        {
            echo " whispered: <br>&quot;" . $row['message'] . "&quot;";
        }
        echo "</div>";
    }   
}
else 
{
    echo "<h3>You still haven't received any messages yet.</h3>";
}