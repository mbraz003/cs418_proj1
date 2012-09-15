<?php
function debugDisplay()
{
?>
<pre>
$_POST
<?php
print_r($_POST);
?>
$_GET
<?php
print_r($_GET);
?>
</pre>
<?php
}
?>