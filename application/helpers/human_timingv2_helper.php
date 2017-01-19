<?php
	function human_timingv2($time) {
		$time = strtotime($time);

	    $time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'yıllık',
	        2592000 => 'aylık',
	        604800 => 'haftalık',
	        86400 => 'günlük',
	        3600 => 'saatlik',
	        60 => 'dakikalık',
	        1 => 'saniyelik'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'':'');
	    }

	}
?>
