<?php

/* SETTING DEFAULT PATH */
// DEFAULT PATH TO ASSETS
function assetsUrl(){
	return base_url().'static/assets/';
}

// NUMBER FORMAT
function humanizeNumber($numberString){
	$formatNumber = number_format($numberString,0,",",".");
	return $formatNumber;
}

// INDONESIA DATE FORMAT
function indonesianDate($dateString){
	return date('d-m-Y', strtotime($dateString));
}

// INDONESIA DATETIME FORMAT
function indonesianDateTime($dateString){
	return date('d-m-Y H:i:s', strtotime($dateString));
}
?>
