<?php
include('../config.php');

session_start();
/*if (isset($_GET['payment']) && $_GET['payment'] == 'confirm' && isset($_GET['paymentid']) && ctype_digit($_GET['paymentid'])) {
	mysql_query("UPDATE payments SET status = 'Completed' WHERE id = ".mysql_real_escape_string($_GET['paymentid']));
	header('Location: /admin');
}*/

if (isset($_POST['print'])) {
	$ids = '';
	foreach ($_POST['print'] as $val) {
		if ($ids === '') {
			$ids .= mysql_real_escape_string($val);
		} else {
			$ids .= ', '.mysql_real_escape_string($val);
		}
	}
	$query = "SELECT * FROM payments WHERE id IN (".$ids.")";
	$paymentsinfo = mysql_query($query);
	if (isset($_POST['export'])) {
		$query = "UPDATE payments SET archive = 1 WHERE id IN(".$ids.")";
		mysql_query($query);
		$csv = array(
			array("NAME", "ZUSATZ", "STRASSE", "NUMMER", "PLZ", "STADT", "LAND", "ADRESS_TYP"),
			array("www.alltop-und-billig.de", "", "Internetservice Lieferung", "", "", "Berlin", "DE", "HOUSE")
		);
		if (mysql_num_rows($paymentsinfo) > 0) {
			$k = 2;
			while ($pi = mysql_fetch_assoc($paymentsinfo)) {
				$streettxt = $pi['address'];
				if (strpos($streettxt, "\r\nbei ") > 0) {
					$bei = substr($streettxt, strpos($streettxt, "\r\nbei "), strlen($streettxt) - strpos($streettxt, "\r\nbei "));
					$bei = preg_replace('~[\r\n]+~', '', $bei);
					$streettxt = str_replace($bei, '', $streettxt);
					$streettxt = preg_replace('~[\r\n]+~', '', $streettxt);
				}
				if (strpos($streettxt, " bei ") > 0) {
					$bei = substr($streettxt, strpos($streettxt, " bei "), strlen($streettxt) - strpos($streettxt, " bei "));
					$streettxt = str_replace($bei, '', $streettxt);
				}
				$csv[$k][] = $pi['name'].' '.$bei;
				$csv[$k][] = "Bewertungs Nummer ".$pi['trid'];
				$csv[$k][] = $streettxt;
				$csv[$k][] = "";
				$csv[$k][] = $pi['zip'];
				$csv[$k][] = "Berlin";
				$csv[$k][] = "DE";
				$csv[$k][] = "HOUSE";
				$k++;
			}
		}
		mysql_query("UPADTE payments SET archive = 1 WHERE id IN (".$ids.")");
		//$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/admin/Empfanger.csv', 'w');
		$file = '';
		foreach ($csv as $val) {
			$newline = FALSE;
			foreach ($val as $value) {
				if ($newline === FALSE) {
					$file .= $value;
				} else {
					$file .= ';'.$value;
				}
				$newline = TRUE;
			}
			$file .= "\r\n";
		}
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/admin/Empfanger.csv')) {
			unlink($_SERVER['DOCUMENT_ROOT'].'/admin/Empfanger.csv');
		}
		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/admin/Empfanger.csv', $file);
		//fclose($fp);
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename('Empfanger.csv'));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($_SERVER['DOCUMENT_ROOT'].'/admin/Empfanger.csv'));
		readfile($_SERVER['DOCUMENT_ROOT'].'/admin/Empfanger.csv');
		exit;
	} elseif (isset($_POST['delete'])) {
		if (count($_POST['print']) == mysql_num_rows($paymentsinfo)) {
			mysql_query("DELETE FROM payments WHERE id IN (".$ids.")");
		}
	}
}
?>
<html>
<head>
<title>CommentSystem - Admin</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<meta charset="utf-8">
<script Language="JavaScript">
function toggle(id)
{
	var e = document.getElementById(id);
	var dh = gh(id);
	var elems = e.getElementsByTagName('*');
	var flag;
	
	if (e.style.display == "none")
	{
		if (flag != 0)
		{
			flag = 0;
			for(var i=0; i<elems.length; i++){vhe(elems[i], "hidden");}
		
			e.style.height="1px";
			e.style.display = "block";
			for(var i=0;i<=100;i+=5)
			{
				(function()
					{
						var pos=i;
						setTimeout(function(){e.style.height = (pos/100)*dh+1+"px";},pos*5);
					}
				)();
			}
			setTimeout(function(){for(var i=0; i<elems.length; i++){elems[i].style.visibility="visible";}},500);
			return true;
			flag = 1;
		}
	}
	else
	{
		if (flag != 0)
		{
			flag = 0;
			var lh=dh-1+"px";
			
			for(var i=0; i<elems.length; i++){vhe(elems[i], "hidden");}
			
			for (var i=100;i>=0;i-=5)
			{
				(function()
					{
						var pos=i;
						setTimeout(function()
						{
							e.style.height = (pos/100)*dh+"px";
							if (pos<=0)
							{
								e.style.display = "none";
								e.style.height=lh;
							}
						},1000-(pos*5));
					}
				)();
			}
			return true;
			flag = 1;
		}
	}
	return false;
}
function vhe(obj, vh){obj.style.visibility=vh;}
function gh(id)
{
	var e = document.getElementById(id);
	if(e.style.display == "none")
	{
		e.style.visibility = "hidden";
		e.style.display = "block";
		dh = e.clientHeight||e.offsetHeight+5; // Высота
		e.style.display = "none";
		e.style.visibility = "visible";
	}
	else
	{
		dh = e.clientHeight||e.offsetHeight+5; // Высота
	}
	return dh;
}
</script>
</head>
<body>
<center>
<div id="content">
<?
//проверяем пароль
if(isset($_POST['admin_pass']))
{
	if($admin_pass == $_POST['admin_pass'])
	{
		$_SESSION['admin_pass'] = true;
	}
}

if($_SESSION['admin_pass']) {
	if (isset($_GET['p']) && ctype_digit($_GET['p'])) {
		$page = $_GET['p'];
	} else {
		$page = 0;
	}
	if ($_GET['q'] == 'archive') {
		$q = 1;
	} else {
		$q = 0;
	}
	$orders = mysql_query("SELECT * FROM payments WHERE archive = ".$q." ORDER BY id DESC");
	if(isset($_GET['good'])){$public=1;}
	elseif(isset($_GET['moderate'])){$public=0;}
	else{$public=0;}
	//одобряем
	if(isset($_GET['good_comment']))
	{
	$id = $_GET['good_comment'];
	mysql_query("update ".$c_tab." set public = '1' where id = '{$id}'") or die ("Error! query - set");	
	}
	//удаляем
	if(isset($_GET['delete']))
	{
	$id = $_GET['delete'];
	mysql_query("delete from ".$c_tab." where id = '{$id}'") or die ("Error! query - delete");
	}
	//Завершаем работу
	if(isset($_GET['end']))
	{
	session_destroy();
	echo "Session finished! If you want to continue, Refresh the page and Login again.";
	return;
	}

	function countcomments($pub)
	{
		include('../config.php');
		$res = mysql_query("select count(id) from ".$c_tab." where public='".$pub."'", $con);
		$arr = mysql_fetch_array($res, MYSQL_NUM); return $arr[0];
	}

	$res = mysql_query("select * from ".$c_tab." where public='".$public."'", $con) or die ("Error!");
	while($arr = mysql_fetch_array($res, MYSQL_NUM))
	{
		$comments[$arr[0]]['id'] = $arr[0];
		$comments[$arr[0]]['parent_id'] = $arr[1];
		$comments[$arr[0]]['url_id'] = $arr[2];
		$comments[$arr[0]]['id_material'] = $arr[3];
		$comments[$arr[0]]['name'] = $arr[4];
		$comments[$arr[0]]['profession'] = $arr[5];
		$comments[$arr[0]]['url'] = $arr[6];
		$comments[$arr[0]]['mail'] = $arr[7];
		$comments[$arr[0]]['text'] = $arr[8];
		$comments[$arr[0]]['date_add'] = $arr[9];
		$comments[$arr[0]]['public'] = $arr[10];
	}
	?>
	<div id="orders">
		<div style="text-align: left;">
			<a href="?q=actorders" style="display: inline-block; margin-right: 10px; font-size: 16px;">Активные заказы</a>
			<a href="?q=archive" style="font-size: 16px;">Архив заказов</a>
		</div>
		<?php if (mysql_num_rows($orders) != 0): ?>
		<form action="" method="POST">
			<table width="100%" cellpadding="0" cellspacing="0" align="center" class="orders">
				<tbody>
				<?php while ($orders_array = mysql_fetch_assoc($orders)): ?>
				<tr data-id="<?php echo $orders_array['id'] ?>">
					<td><?php echo $orders_array['id'] ?></td>
					<td><?php echo $orders_array['name'] ?></td>
					<td><?php echo $orders_array['address'] ?></td>
					<td><?php echo $orders_array['email'] ?></td>
					<td><?php echo $orders_array['phone'] ?></td>
					<td><?php echo $orders_array['item_name'] ?></td>
					<?php if ($q == 0): ?>
					<?php
						if ($orders_array['status'] == 'Completed') {
							$status = '<img src="img/green-ok.png" alt="" title="" width="12"><span>Оплачено</span>';
						} elseif ($orders_array['status'] == 'Pending') {
							$status = '<img src="img/ec-card.jpg" alt="" title="" width="12"><span>Ожидание</span>';
						} elseif ($orders_array['status'] == 'Refunded') {
							$status = '<img src="img/red-not-ok.png" alt="" title="" width="12"><span>Возврат</span>';
						} elseif ($orders_array['status'] == 'Denied') {
							$status = '<img src="img/red-not-ok.png" alt="" title="" width="12"><span>Отменен</span>';
						} elseif ($orders_array['status'] == 'Failed') {
							$status = '<img src="img/red-not-ok.png" alt="" title="" width="12"><span>Проблемный</span>';
						} else {
							$status = '<p>'.$orders_array['status'].'</p>';
						}
					?>
					<td style="text-align: center;" class="statusbl"><?php echo $status  ?></td>
					<td style="text-align: center;"><input type="checkbox" name="print[<?php echo $orders_array['id'] ?>]" id="print<?php echo $orders_array['id'] ?>" value="<?php echo $orders_array['id'] ?>"></td>
					<?php endif ?>
				</tr>
				<?php endwhile ?>
				<?php if ($q == 0): ?>
				<tr>
					<td colspan="8" style="text-align: right;">
						<input type="submit" name="delete" value="Удалить">
						<input type="submit" name="export" value="Выслать">
					</td>
				</tr>
				<?php endif ?>
				</tbody>
			</table>
		</form>
		<?php else: ?>
		<?php endif ?>
	</div>
	<div class="com">
	<div id="head">
		<? if(countcomments(0)>0): ?><a href="?moderate">Checking</a> <font color="red">[<?=countcomments(0)?>]</font><? endif; ?>
		<? if(countcomments(1)>0): ?><a href="?good">Accepted</a> <font color="green">[<?=countcomments(1)?>]</font><? endif; ?>
	<? //include('settings.php'); ?>
	[<a href="?end">Exit</a>]</div> 
		<table class="list" cellspacing="0" cellpadding="0">
		<? if(count($comments)>0): ?>
			<? foreach($comments as $item): ?>
			<tr>
				<td class="left"  valign='top'>
					<ul>
						<? if($item['public'] == 0): ?>
						
						<li><img src="good.gif"/><a href="?good_comment=<?=$item['id']?>">Accept</a></li>
						
						<? else: ?>
							Accepted
						<? endif; ?>
						
						<li><img src="material.gif"/><a href="http://<?=$item['url_id']?>" target="_blank">Look Comment</a></li>
						<li><img src="comment.gif"/><a href="http://<?=$item['url_id']?>#<?=$item['id']?>" target="_blank"> Go to Comment page </a></li>
						<li><img src="delete.gif"/><a href="?delete=<?=$item['id']?>" onclick="return confirm('Delete comment?');">Delete</a></li>
					</ul>
				</td>
				
				<td class="right" valign='top'>
					<div class="title">
                    		Name: <b><?=$item['name']?> </b> ||
                            Profession: <b> <?=$item['profession']?> </b> ||
                            <?php/*Product No. <b>$item['url']</b> ||*/?>
							Date: <b><?=$item['date_add']?></b>
						
					</div>
					<div class="text"><br>
						<?=$item['text']?>
					</div>
				</td>
			</tr>
			<? endforeach; ?>
		<? else: ?>
			<tr>
				<td>
					<br>No new Comments!<br><br>
				</td>
			</tr>
		<? endif; ?>
		</table>
	</div>
<?
}
else
{
?>
<br>
<form action="index.php" method="POST">
Input prid<br>
<input type="prid" name="admin_pass"/>
<input type="submit" value="Logout"/>
</form>
<br>
<?
}
?>
</div>
</center>
</body>
</html>