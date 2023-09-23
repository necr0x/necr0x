<?php

function parentcomments()
{
	global $id_pref, $c_max, $url_type, $c_tab, $uid, $reply, $wait_good, $theme_path;
	include('config.php');
	mysql_query('SET NAMES utf8');
	$res = mysql_query("select * from ".$c_tab." where url_id like '".$uid."' and parent_id='0' order by id DESC limit 0,".$c_max, $con) or die ("Error! query - show");
	while($arr = mysql_fetch_array($res, MYSQL_NUM))
	{
		$name = $arr[4];
		
		if($arr[10]==0){$text = $arr[8].templater($theme_path."wait_for_good.php", "[#wait_good]", $wait_good);}
		else{$text = $arr[8];}
		$keys = array("[#id]","[#name]","[#profession]","[#date]","[#text]","[#reply]","[#subs]");
		$vals = array($id_pref.$arr[0],$name,$arr[5],$arr[9],$text,$reply, subcomments($arr[0]));
		echo templater($theme_path."comment.php", $keys, $vals);
	}
}

?>