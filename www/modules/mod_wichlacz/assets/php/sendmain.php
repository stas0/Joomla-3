<?php
	require_once '../../lib/mailpear.php';
	
	$mailpear = new MailPear();
	
	$html = '<p><b>Email: </b>'. $_POST['mailSender'] .'</p>';
	$html .= '<p><b>Имя: </b>'. $_POST['name'] .'</p>';
	$html .= '<p><b>Телефон: </b>'. $_POST['phone'] .'</p>';
	$html .= '<p><b>Регион: </b>'. $_POST['region'] .'</p>';
	$html .= '<p><b>Грод: </b>'. $_POST['city'] .'</p>';
	
	$mailpear->setTo($_POST['mailRecipient']);
	$mailpear->setFrom($_POST['mailSender']);
	$mailpear->setHtml($html);
	$mailpear->setSubject('Ищем дилеров!');
	
	$mailpear->send();
	
	echo '1';
	//print_r($_POST);
?>