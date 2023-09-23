<?php 
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
sleep(1);
while(list ($key, $val) = each ($_POST)){$_POST[$key]=iconv("UTF-8","UTF-8", $_POST[$key]);}

include('comments/includes.php');
include('lang.php');
include('config.php');

if(isset($_POST['uid']))
{
	$d = date('d.m.Y');
	$pub = 0;
	if(!isset($_POST['pid'])){$pid='';}else
	{
		$countprefiks = strlen($id_pref);
		$pid=substr($_POST['pid'], $countprefiks);
	}
	$uid=$_POST['uid'];
	if(!isset($_POST['idm'])){$idm='';}else{$idm=$_POST['idm'];}

$n = $_POST['name']; $p = $_POST['profession'];  $s=trim($_POST['site']); $t = $_POST['text'];
	if($n==$name_area){$n='';}
	if($p==$profession){$p='';}
	if($s==$site_area){$s='';}
	if($t==$text_area){$t='';}
	$nl = strlen($n);
	$pl = strlen($p);
	$ml = strlen($u);
	$tl = strlen($t);

	if( $nl>60 or $pl>20 or $t=='' or $n=='' or $p=='' or $tl>1500)
	{
		$validate = false;
	}
	
	elseif($s!='')
	{
		if(preg_match('/^[a-z0-9]+$/', $s))
		{
			$validate = true;
		}
	}
	else
	{
		$validate = false;
	}
	
	if($validate)
	{
		include('config.php');
		
		mysql_query("insert into ".$c_tab." (parent_id,url_id,id_material,name,profession,url,text,date_add,public) values ('{$pid}','{$uid}','{$idm}','{$n}','{$p}','{$s}','{$t}','{$d}','{$pub}')") or die ("Err!");
		$keys = array("[#name]","[#profession]","[#date]","[#text]","[#res_ok]");
		$vals = array($n,$p,$d,$t,$res_ok);
		echo templater($theme_path."response_good.php", $keys, $vals);
	}
	else
	{
		$keys = array("[#res_err]");
		$vals = array($res_err);
		echo templater($theme_path."response_error.php", $keys, $vals);
	}
}
else
{
	echo "ERROR, unknown UID!";
}

?>