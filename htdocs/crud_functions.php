<?php
function alert($arg_message, $arg_type) {
	echo "<div class=\"alert alert-$arg_type alert-dismissible fade show\" role=\"alert\" id=\"alert_$arg_type\">";
		echo "$arg_message";
		echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">";
			echo "<span aria-hidden=\"true\">&times;</span>";
		echo "</button>";
	echo "</div>";
}
?>
