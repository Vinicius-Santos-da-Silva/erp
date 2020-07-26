<?php 

use Aws\Ses\SesClient;
use Aws\Credentials\Credentials;
use Aws\Exception\AwsException;

class AWSSES
{
	
	public function send($email){
	$message = 'Não foi possível enviar o convite para '.$email;

        $region = 'us-east-2';
        $version = 'latest';
        $access_key = 'AKIAVC35Q2RX3KIUI7NX';
        $access_key_secret = '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';

        $credentials = new Credentials( $access_key, $access_key_secret);

        $config = array
        (
            'version' => $version, 
            'region'  => $region, 
            'credentials' => $credentials,
        );

        $SesClient = new SesClient($config);

        $sender_email = 'vinicius.unisinos@hotmail.com';

        $recipient_emails = [
            $sender_email
        ];

        $url = '';

        $configuration_set = 'ConfigSet';

        $subject = 'Redefinir Senha - PLATAFORMA GABSTER';
        $plaintext_body = '' ;
        $html_body =  "<a style=\"text-align:center;width:100%;\">\n<table style=\"margin:0 auto;width:50%;font-family: 'Open Sans', sans-serif;\" cellspacing=\"0\">\n  <tr>\n    <td>\n      <div>\n        <img style=\"width:100%;\" src=\"https://s3.amazonaws.com/cdn2.gabster.com.br/static/email-convite-background.png\" />\n      </div>\n    </td>\n  </tr>\n  <tr>\n    <td style=\"font-size:16px;text-align:center;color:#959595;padding-top:25px;\"></td>\n  </tr>\n  <tr>\n    <td style=\"font-size:24px;text-align:center;color:#07365e;font-weight:600;    letter-spacing: 1px;\">PLATAFORMA GABSTER</td>\n  </tr>\n  <tr>\n    <td style=\" font-size:22px;text-align:center;color:#5d5d5d;    letter-spacing: 1px;\"></td> \n  </tr>\n  <tr>\n    <td style=\"  cfont-size:16px;text-align:center;color:#808080;padding-top:20px;font-weight:300;line-height:22px;\"></td> \n  </tr>\n  <tr>\n    <td style=\"text-align:center;padding-top:40px;\">\n      <a href=\"".$url."\" target=\"_blank\" style=\"text-decoration: none;cursor:pointer;padding:14px 20px;font-size:16px;color:#fff;background-color:#C46F0E;border-radius:8px;text-transform:uppercase;font-weight:500;\">Redefinir senha</a>\n    </td>\n  </tr>\n  <tr>\n    <td style=\"text-align:center; ;color:#07365e;   padding:0px;\">\n      <div style=\"margin-top:60px;padding-top:20px;background-color:#f1f1f1;font-weight:300;\">\n        Siga-nos nas redes sociais !\n    \n      </div>\n      \n    </td>\n  </tr>\n<tr>\n    <td style=\"text-align:center;color:#07365e;background-color:#f1f1f1;padding-top:5px;font-weight:300;\">\n      <div>Fique por dentro de todas as nossas ações.</div>\n    </td>\n  </tr>\n  <tr>\n    <td  style=\"text-align:center;color:#07365e;padding:20px 0 20px 0;background-color:#f1f1f1;\">\n      <a target=\"_blank\" rel=\"noopener noreferrer\" href=\"https://www.facebook.com/plataforma.gabster\" style=\"display: inline-block;width: 40px;\n    height: 40px;\n    border: 1px solid #99adbe;\">     <img style=\"width:100%;\" src=\"https://s3.amazonaws.com/cdn2.gabster.com.br/static/icone-facebook.png\" /></a>\n <a target=\"_blank\" rel=\"noopener noreferrer\" href=\"https://www.instagram.com/plataformagabster/\" style=\"display: inline-block;width: 40px;\n    height: 40px;\n    border: 1px solid #99adbe;\"> <img style=\"width:100%;\" src=\"https://s3.amazonaws.com/cdn2.gabster.com.br/static/icone-instagram.png\" /></a>\n       <a target=\"_blank\" rel=\"noopener noreferrer\" href=\"https://pt.linkedin.com/company/gabster-servi-os-em-tecnologia-da-informa-o\"  style=\"display: inline-block;width: 40px;\n    height: 40px;\n    border: 1px solid #99adbe;\"><img style=\"width:100%;\" src=\"https://s3.amazonaws.com/cdn2.gabster.com.br/static/icone-linkedin.png\" /></a>\n      <a target=\"_blank\" rel=\"noopener noreferrer\" href=\"https://www.youtube.com/user/TecnologiaGabster\" style=\"display: inline-block;width: 40px;\n    height: 40px;\n    border: 1px solid #99adbe;\"> <img style=\"width:100%;\" src=\"https://s3.amazonaws.com/cdn2.gabster.com.br/static/icone-youtube.png\" /></a>\n       \n    </td>\n  </tr>\n</table>\n  </div>";

        $char_set = 'UTF-8';

        try {
            $result = $SesClient->sendEmail([
                'Destination' => [
                    'ToAddresses' => $recipient_emails,
                ],
                'ReplyToAddresses' => $recipient_emails,
                'Source' => $sender_email,
                'Message' => [
                    'Body' => [
                        'Html' => [
                            'Charset' => $char_set,
                            'Data' => $html_body,
                        ],
                        'Text' => [
                            'Charset' => $char_set,
                            'Data' => $plaintext_body,
                        ],
                    ],
                    'Subject' => [
                        'Charset' => $char_set,
                        'Data' => $subject,
                    ],
                ],


            #'ConfigurationSetName' => $configuration_set,
            ]);
            $messageId = $result['MessageId'];

            $message = 'Convite enviado com sucesso para: '.$email;
        } catch (\AwsException $e) {

            $message = "The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n";
            
        }

        return $message;
    }
}