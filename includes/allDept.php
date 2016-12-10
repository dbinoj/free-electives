<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$query = "select distinct dept from students order by dept";
$result = mysql_query($query);
print "<select id=dept name=dept>";
while ($row=mysql_fetch_array($result))
{
    echo '<option value="'.$row['dept'].'">'.$row['dept'].'</option>';
}
print "</select>";


?>
