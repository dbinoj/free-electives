 <?php

$query = "select * from subjects where slot='B' order by sid";
$result = mysql_query($query);
print "<select id=tchoice2 name=tchoice2>";
print "<OPTION value='NULL'> - Select Choice - </OPTION>";
while ($row=mysql_fetch_array($result))
{
    /*
     * Checking if the subject belongs to the user's school
     */
    if(checkDep($row["department"]))
    {
    echo '<option value="'.$row['sid'].'">'."[".$row['code']."]".$row['name'].'</option>';
    }
}
print "</select>";


?>
