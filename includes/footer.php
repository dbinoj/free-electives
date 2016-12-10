<?php

/* Check if connections are getting closed.
 * Second close check makes sure that there are no
 * zombie connections after connection is closed once.

if(mysql_close())
	echo "CLOSED<br>";
else
	echo "CLOSE FAILED<br>";

if(mysql_close())
        echo "CLOSED";
else 
        echo "CLOSE FAILED";
*/

mysql_close();

?>
<div id="footer">
    <p><strong>Copyright &copy; <?php echo date('Y'); ?> </strong><a target="_blank" href="http://ctc.karunya.edu"> Computer Technology Center</a></p>
</div>
</body>
</html>
