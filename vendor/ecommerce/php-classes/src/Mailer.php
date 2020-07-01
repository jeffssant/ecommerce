<?php 

namespace Ecommerce;
use Rain\Tpl;

class Mailer 
{
    const USERNAME = "santana.jeff@gmail.com";
    const PASSWORD = 'senhaexemplo';
    const NAME_FROM = 'Ecommerce';

    private $mail;

    public function __construct($toAddress, $toName, $subject, $tplName, $data = array())
	{
      
        $tpl_dir = "/views/";
        
          // Configurações padrão
        // Config RainTPL      
        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir."email/",
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false
        );
        
       
           
        Tpl::configure( $config );

        // create the Tpl object
        $tpl = new Tpl;

        foreach ($data as $key => $value) {
			$tpl->assign($key, $value);
		}

        $html = $tpl->draw($tplName, true);

        $this->mail = new \PHPMailer;

    
        $this->mail->isSMTP();

     
        $this->mail->SMTPDebug = 0;

        //Set the hostname of the mail server
        $this->mail->Host = 'smtp.gmail.com';
     

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->mail->Port = 587;

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $this->mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $this->mail->Username = Mailer::USERNAME;

        //Password to use for SMTP authentication
        $this->mail->Password = Mailer::PASSWORD;

        //Set who the message is to be sent from
        $this->mail->setFrom(Mailer::USERNAME, Mailer::NAME_FROM);


     //Set who the message is to be sent to
		$this->mail->addAddress($toAddress, $toName);

        //Set the subject line
		$this->mail->Subject = $subject;

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$this->mail->msgHTML($html);

		//Replace the plain text body with one created manually
		$this->mail->AltBody = 'This is a plain-text message body';

       
    }

    public function send()
    {
         //send the message, check for errors
         if (!$this->mail->send()) {
            echo 'Mailer Error: '. $this->mail->ErrorInfo;
        } else {
            echo 'Message sent!';
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($this->mail)) {
            #    echo "Message saved!";
            #}
        }
    }
}   