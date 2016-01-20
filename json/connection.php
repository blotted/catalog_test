<?php

try{
	$pdo = new PDO('mysql:host=localhost;dbname=site_catalog', 'vasya', 'vasya');
	$pdo->query('SET NAMES "UTF-8"');

} catch(PDOException $exc) {
	echo "Ошибка при работе с БД ".$exc->getMessage(); 
}