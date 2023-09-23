<?php require_once("fgcontactform.php");
$formproc = new FGContactForm();
$formproc->AddRecipient('kasanmarket@gmail.com'); //<<---Put your email address here
$formproc->SetFormRandomKey('4kIqXpp7v2Ks9OS'); 
if(isset($_POST['submitted']))
{
   if($formproc->ProcessForm())
   {
        $formproc->RedirectToURL("danke.php");
   }
} ?>

<?php include("header.php"); ?>
<script type='text/javascript' src='js/gen_validatorv31.js'></script>

<div class="container"> 
    <div class="contact_form_txt_area">
        <p class="top_title">  Kontaktieren Sie Uns  </p> <br>
        <span class="contact_form_txt">
            <p>Liebe Kunden, im Falle, wenn bei Ihnen Fragen entstehen, die mithilfe der <a class="link_style" href="worksafe.php">Worksafe</a> Startseite oder <a class="link_style" href="faq_s.php">Info faq's</a> nicht beantwortet werden konnten, geben wir Ihnen die Möglichkeit für das Antwort Mit dem Feedback-Formular geben.</p>
            <p>Wir bitten Sie, die Fragen so deutlich wie möglich, zu formulieren. Geben Sie dabei in die unbedingt Ihren Namen, Ihre aktuelle Email-Adresse. Die Antwort erfolgt immer an die angegebene Adresse.</p>
            <p>Es uns sehr wichtig, dass Sie nach dem Erhalten unseres Produktes, der Handschuhen WorkSafe Precision unbedingt Ihren <a class="link_style" href="bewertungen.php">Bewertung</a> geben. Somit helfen Sie uns, unseren Service zu verbessern und Fehler zu korrigieren, wenn diese entstehen. Außerdem motivieren Sie mit Ihren Kommentaren andere Kunden zum Kauf der Handschuhe WorkSafe Precision.</p>
        </span>
    </div>
    <div class="contuct_form"> 	<br>
        <p class="top_title"> Schreiben Sie Ihre Frage </p> <br>
        <form id='contactus' action='<?php echo $formproc->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            <input type='hidden' name='<?php echo $formproc->GetFormIDInputName(); ?>' value='<?php echo $formproc->GetFormIDInputValue(); ?>'/>
            <input type='text'  class='spmhidip' name='<?php echo $formproc->GetSpamTrapInputName(); ?>' />
            <input type='text' autocomplete="off" class="name_email" name='name' required id='name' value='<?php echo $formproc->SafeDisplay('name') ?>'  maxlength="50" placeholder="Ihr Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ihre Name'"/>
            <input type='text' autocomplete="off" class="name_email" name='email' required id='email' value='<?php echo $formproc->SafeDisplay('email') ?>' maxlength="50" placeholder="Ihre Email-Adresse" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ihre Email'" /><br/>
            <div class="err">
                <span id='contactus_name_errorloc'></span><br>
                <span id='contactus_email_errorloc'></span><br>
                <span id='contactus_message_errorloc'></span>
                <span class='error'><?php echo $formproc->GetErrorMessage(); ?></span>
            </div>
            <textarea class="textarea" rows="10" cols="50" name='message' id='message' required placeholder="Ihre Frage" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ihre Frage'"><?php echo $formproc->SafeDisplay('message') ?></textarea>
                <input class="submit_reset" type='submit' value='Senden' />
       </form>

        <script type='text/javascript'>
        // <![CDATA[

            var frmvalidator  = new Validator("contactus");
            frmvalidator.EnableOnPageErrorDisplay();
            frmvalidator.EnableMsgsTogether();
                frmvalidator.addValidation("name","req","Bitte geben Sie Ihre Name"); 
                frmvalidator.addValidation("email","req","Bitte geben Sie Ihre E-mail Adresse");
                frmvalidator.addValidation("message","req","Bitte schreiben Sie Ihre Frage");
                frmvalidator.addValidation("email","email","Bitte überprüfen Sie Ihre E-Mail Adresse!");

        // ]]>
        </script>

    </div>	
    <div class="clear"> </div>
</div>
<?php include("footer.php"); ?>