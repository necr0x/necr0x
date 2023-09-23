<?php
	$hostname="mysql1122.opentransfer.com"; // Имя хоста
	$login="A880513_admin"; // Логин для подкл. к серверу баз даных
	$pwd="W0rksaf3!!"; // Пароль для подкл. к серверу баз даных	
	$db_name="A880513_WorkSafe"; // Название базы даных
	
	$admin_pass="!Fuck1Ng@dmiN";// Пароль администратора
	$system_path="http://alltop-und-billig.de/"; // путь к корневой папке комментариев
	$theme_path=$system_path."themes/default/"; // путь к корневой папке темы
	$c_tab="commentsystem"; // таблица с комментариями в БД
	$s_tab="commentsetings"; // таблица с настройками в БД
	$c_max=99999; // максимальное количество комментариев
	$url_type="df"; // Режим ссылок на личные сайты, блоги пользователей: df - dofollow (прямая ссылка), nf - nofollow (неиндексируемая ссылка), js - javascript ссылка
	
	// всякие тонкости
	$id_pref=""; // префикс ида на комментарий (comment-1, comment-2 ...) - для совместимости с другими html элементами
    //подключение к базе
    $con = @mysql_connect($hostname, $login, $pwd) or die("Error! connect-database");
	mysql_query('SET NAMES utf8');
	mysql_select_db($db_name, $con) or die ("Error! select-database");

?>