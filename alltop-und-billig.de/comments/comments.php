<?php ob_start('comments_compress');

$dom = $_SERVER['SERVER_NAME'];
$page = $_SERVER['REQUEST_URI'];
$uid=$dom.$page;

include('config.php');
include('includes.php');
include('lang.php');

$lb=get_label();

if (isset($_POST['addcomment'])) {
	$commentserror = array();
	if (isset($_POST['name'])) {
		$name = trim(strip_tags($_POST['name']));
		if ($name == '' || strlen($name) > 16) {
			$commentserror['name'] = TRUE;
		} else {
			$name = mysql_real_escape_string($name);
		}
	} else {
		$commentserror['name'] = TRUE;
	}
	
	if (isset($_POST['profession'])) {
		$profession = trim(strip_tags($_POST['profession']));
		if ($profession == '' || strlen($profession) > 25) {
			$commentserror['profession'] = TRUE;
		} else {
			$profession = mysql_real_escape_string($profession);
		}
	} else {
		$commentserror['profession'] = TRUE;
	}
	
	if (isset($_POST['code'])) {
		$code = trim(strip_tags($_POST['code']));
		if ($code == '' || strlen($code) > 6) {
			$commentserror['code'] = TRUE;
		} else {
			$code = mysql_real_escape_string($code);
			$query = "SELECT * FROM payments WHERE trid='".$code."'";
			$res = mysql_query($query);
			$pcount = mysql_num_rows($res);
			if ($pcount != 1) {
				$commentserror['code'] = TRUE;
			}
		}
	} else {
		$commentserror['code'] = TRUE;
	}

	if (isset($_POST['text'])) {
		$text = trim(strip_tags($_POST['text']));
		if ($text == '' || strlen($text) > 280) {
			$commentserror['text'] = TRUE;
		} else {
			$text = mysql_real_escape_string($text);
		}
	} else {
		$commentserror['text'] = TRUE;
	}
	
	if (count($commentserror) == 0) {
		$query = "INSERT INTO commentsystem (parent_id, url_id, id_material, name, profession, url, mail, text, date_add, public) VALUES (0, '".$uid."', '', '".$name."', '".$profession."', '".$code."', '', '".$text."', '".date('d.m.Y')."', 0)";
		mysql_query($query);
	}
	
}

?>
<script Language="JavaScript">
function obj(){var rt;var b = navigator.appName;if(b == "Microsoft Internet Explorer"){var rt = new ActiveXObject("Microsoft.XMLHTTP");
}else{var rt = new XMLHttpRequest();}return rt;}
function ajax(p)
{
	var r = obj();
	m=(!p.method ? "POST" : p.method.toUpperCase());
	
	if(m=="GET")
	{
		send=null;
		p.url=p.url+"&ajax=true";
	}
	else
	{
		send="";
		for (var i in p.data) send+= i+"="+p.data[i]+"&";
		send=send+"ajax=true";
	}
	
	r.open(m, p.url, true);
	if(p.statbox)document.getElementById(p.statbox).innerHTML = '<? echo templater($theme_path."wait.php", array('[#theme_path]','[#wait]'), array($theme_path,$wait_text)); ?>';
	r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	r.send(send);
	r.onreadystatechange = function()
	{
		if (r.readyState == 4 && r.status == 200)
		{
			if(p.success)p.success(r.responseText);
		}
	}
}
function ct(f){if (f.defaultValue == f.value) f.value = '';else if (f.value == '') f.value = f.defaultValue;}
function gbi(id){var e = document.getElementById(id); return e;}

</script>

	<div class="input_comment_area">
    	 <div class="contact_form_txt_area">
            	<p class="top_title">  Live Comments </p> <br>
                <span class="contact_form_txt">
                	<p>
                    	Es uns sehr wichtig, dass Sie nach dem Erhalten unseres Produktes, der Handschuhen WorkSafe Precision unbedingt Ihren Feedback geben. Somit helfen Sie uns, unseren Service zu verbessern und Fehler zu korrigieren, wenn diese entstehen. Außerdem motivieren Sie mit Ihren Kommentaren andere Kunden zum Kauf der Handschuhe WorkSafe Precision.
                    </p>
                            
                	<p>Nur wir bieten Ihnen ein System der „live comments“! Das bedeutet, dass Sie Ihre Kommentare erst nach dem Erhalt des Produktes und nach der Überprüfung seiner Qualität verfassen können.</p>
                </span>
                
                                
				
		</div>
			
        <div id="cf">
        	<br><p class="top_title">  Bewerten Sie Uns  </p>	
        	<br>
            
			<form method="POST" action>
				<div id="scf" style="color:#786b64">
					<?php if (isset($commentserror) && count($commentserror) > 0): ?>
					<p class="err commenterror"> Uberprüfen Sie bitte Bestellungskode</p>
					<?php endif ?>
					<br>
					<input type="text" class="aling_center" id="name" name="name" required maxlength="16" onfocus="if (this.placeholder == '<?=$name_area?>') {this.placeholder = ''}" onblur="if (this.placeholder == '') {this.placeholder = '<?=$name_area?>'}" placeholder="<?=$name_area?>">
					
					<input type="text" class="aling_center" id="profession" name="profession" required maxlength="25" onfocus="if (this.placeholder == '<?=$profession?>') {this.placeholder = ''}" onblur="if (this.placeholder == '') {this.placeholder = '<?=$profession?>'}" placeholder="<?= $profession?>"> 
					
					<input type="text" class="aling_center" id="code" name="code" required maxlength="6"  onfocus="if (this.placeholder == '<?=$site_area?>') {this.placeholder = ''}" onblur="if (this.placeholder == '') {this.placeholder = '<?=$site_area?>'}" placeholder="<?=$site_area?>">
					<div class="clear"></div>
					<div class="cmmts">
						<textarea id="text" name="text" maxlength="280" required onfocus="if (this.placeholder == '<?=$text_area?>') {this.placeholder = ''}" onblur="if (this.placeholder == '') {this.placeholder = '<?=$text_area?>'}" placeholder="<?=$text_area?>"></textarea>
					</div>
					<div id="status"></div>
					
				</div>
				
				<input type="submit" class="add" name="addcomment" value="Senden">
			</form>
		</div>
    
		<div class="clear"> </div>  
    
	</div>
    
<?php

function comments_compress($buffer)
{
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer; 
}

ob_end_flush(); ?>
<div class="clear"> </div>
	<ul class="comment_area">
		 <?php /* parentcomments(); */ ?>  
         
		<?php 
			$result = mysql_query("SELECT * FROM $c_tab WHERE public = 1 ORDER BY id DESC limit 0, $c_max ");
			
			while($row=mysql_fetch_array($result))  
			{
		?>
            
            <li class="comment_li">
            	<div id="[#id]" class="f">
					<div class="c">
                        <span class="rd"> <?php echo $row['date_add'];?></span>
                        <div class="txt"> <?php echo ucfirst($row['text']) ?></div>
                        <span class="pr"><b> <?php echo $row['profession'] ?> </b></span>
                        <span class="slash"> - </span>
                        <span class="l"><b><?php echo $row['name'] ?> </b></span>
   					</div>
                    
				</div>
			</li>
            <div class="vertical_line"> </div>
			<?php } ?>
            
        <div class="clear"> </div>  	
	</ul>  