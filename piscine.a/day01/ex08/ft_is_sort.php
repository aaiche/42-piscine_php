<?php 
function ft_is_sort($tab) {
	if(is_array($tab)) {
		$sorted_tab = array_values($tab);
		sort($sorted_tab);
		if ($tab == $sorted_tab)
			return(TRUE);
		else
			return(FALSE);
	}
	return(FALSE);
}
?>
