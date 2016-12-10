 <?php

$query = "select * from subjects order by slot";
$result = mysql_query($query);
print "<select id=subject name=subject>";
while ($row=mysql_fetch_array($result))
{
    echo '<option value="'.$row['sid'].'">'."[".$row['slot']."] - [".$row['code']."] - ".$row['name'].'</option>';
}
print "</select>";


?>

