<?php

	/*
	jika data mau dimasukkan ke database,
	maka perintah SQL INSERT bisa ditulis di sini
	*/

	$data = '';
	foreach ($_POST as $k => $v) {
		$data .= "<option value='$v'> $v </option>";
	}

	echo $data;

?>