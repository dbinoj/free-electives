 <?php

$query = "select distinct name, code from subjects order by name";
$result = mysql_query($query);
print "<select id=subject name=subject>";
while ($row=mysql_fetch_array($result))
{
    echo '<option value="'.$row['code'].'">'."[".$row['code']."] - ".$row['name'].'</option>';
}
print "</select>";


?>

