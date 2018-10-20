<?php 
function ft_split($str) {
	$my_tab = preg_split("/\s+/", $str, -1, PREG_SPLIT_NO_EMPTY);
	sort($my_tab);
	return($my_tab);
}
?>
