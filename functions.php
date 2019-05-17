<?php

function phonenumber($data){

	$data = preg_replace('/[^0-9]/', '', $data);

	if(strlen($data) == 13){
		$rx = "/
		    (\d{2})?\D*   	# optional country code
		    (\d{3})?\D* 	# optional area code
		    (\d{4})\D*  	# first three-four
		    (\d{4})\D*    	# last four
		/x";
	} else if(strlen($data) == 12 OR strlen($data) == 8){
		$rx = "/
		    (\d{2})?\D*   	# optional country code
		    (\d{2})?\D* 	# optional area code
		    (\d{4})\D*  	# first three-four
		    (\d{4})\D*     	# last four
		/x";
	} else if(strlen($data) == 11 OR strlen($data) == 7 OR strlen($data) == 10) {
		$rx = "/
		    (\d{1})?\D*  	# optional country code
		    (\d{3})?\D* 	# optional area code
		    (\d{3})\D*	  	# first three-four
		    (\d{4})\D*     	# last four
		/x";
	} else {
		return $data;
	}
	preg_match($rx, $data, $matches);


	if(!isset($matches[0])) return $data;

	$country = $matches[1];
	$area = $matches[2];
	$three = $matches[3];
	$four = $matches[4];


	$result = ($country ? '+(' . $country . ') ' : '') . ($area ? $area . '-' : '') . $three . '-' . $four  ;
	return $result;

}

function phonenumberlink($data){

	$data = preg_replace('/[^0-9]/', '', $data);

	if(strlen($data) == 13){
		$rx = "/
		    (\d{2})?\D*   	# optional country code
		    (\d{3})?\D* 	# optional area code
		    (\d{4})\D*  	# first three-four
		    (\d{4})\D*    	# last four
		/x";
	} else if(strlen($data) == 12 OR strlen($data) == 8){
		$rx = "/
		    (\d{2})?\D*   	# optional country code
		    (\d{2})?\D* 	# optional area code
		    (\d{4})\D*  	# first three-four
		    (\d{4})\D*     	# last four
		/x";
	} else if(strlen($data) == 11 OR strlen($data) == 7 OR strlen($data) == 10) {
		$rx = "/
		    (\d{1})?\D*  	# optional country code
		    (\d{3})?\D* 	# optional area code
		    (\d{3})\D*	  	# first three-four
		    (\d{4})\D*     	# last four
		/x";
	} else {
		return $data;
	}
	preg_match($rx, $data, $matches);


	if(!isset($matches[0])) return $data;

	$country = $matches[1];
	$area = $matches[2];
	$three = $matches[3];
	$four = $matches[4];


	$result = ($country ? '+' . $country  : '') . ($area ? $area  : '') . $three  . $four  ;
	return $result;

}
?>