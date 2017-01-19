<?php
	function human_timing($time) {
		$time = strtotime($time);

	    $time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'yıl',
	        2592000 => 'ay',
	        604800 => 'hafta',
	        86400 => 'gün',
	        3600 => 'saat',
	        60 => 'dakika',
	        1 => 'sanite'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'':'').' önce';
	    }

	}
?>
