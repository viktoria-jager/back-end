<pre>

<?php


$txt = "<div>   &&&&    asdasdfg            </div>";

var_dump(  htmlspecialchars(trim(strip_tags($txt)))  );


?>


&copy;
&gt;
&lt;
&equiv;