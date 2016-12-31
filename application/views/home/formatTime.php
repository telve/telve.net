<?php
	function formatTime($timer){

		$diff = $_SERVER['REQUEST_TIME'] - $timer;
		$day = floor($diff / 86400);
		$free = $diff % 86400;

		if($day > 0) {
			echo $day." days ago";
		}else{
			if($free>0){
				$hour = floor($free / 3600);
				$free = $free % 3600;
				if($hour>0){
						echo $hour." an hour ago";
				}else{
					if($free>0){
						$min = floor($free / 60);
						$free = $free % 60;
						if($min>0){
							echo $min." minutes ago";
						}else{
							if($free>0){
								echo $free." seconds ago";
							}else{
								echo ' just a moment ago';
							}
						}
					}else{
						echo ' just a moment ago';
					}
				}
			}else{
				echo ' just a moment ago';
			}
		}
	}
?>
