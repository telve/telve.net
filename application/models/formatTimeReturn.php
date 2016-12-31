<?php
	function formatTimeReturn($timer){

		$diff = $_SERVER['REQUEST_TIME'] - $timer;
		$day = floor($diff / 86400);
		$free = $diff % 86400;

		if($day > 0) {
			return $day." days ago";
		}else{
			if($free>0){
				$hour = floor($free / 3600);
				$free = $free % 3600;
				if($hour>0){
						return $hour." an hour ago";
				}else{
					if($free>0){
						$min = floor($free / 60);
						$free = $free % 60;
						if($min>0){
							return $min." minutes ago";
						}else{
							if($free>0){
								return $free." seconds ago";
							}else{
								return ' just a moment ago';
							}
						}
					}else{
						return ' just a moment ago';
					}
				}
			}else{
				return ' just a moment ago';
			}
		}
	}
?>
