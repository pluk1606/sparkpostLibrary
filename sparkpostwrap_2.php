<?php 
require 'sparkpost-files/autoload.php';
require 'guzzle-files/autoload.php';
use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;
class sparkpostwrap extends CApplicationComponent {
	/*
	 	echo('<pre>');
	 	print_r();
	 	echo('</pre>');
	 	Yii::app()->end();
	*/
    public $mandrillKey;
    public $fromEmail;
    public $fromName;
    public $toEmail;
    public $toName;
    public $subject;
    public $countOffers;
    public $getOut;
    public $stopMails;
    public $text;
    public $offersContent;
    public $totalCounter;
    public $objectToSend;
    public $city;
    public $merge_vars;
    public $sub;
	public $authkey;
    public function init() {}
    public function emailActivation() {
    	$httpAdapter = new Guzzle6HttpAdapter(new Client());
    	$sparky = new SparkPost($httpAdapter, ['key'=>"****************************"]);
    	try {
    		$results = $sparky->transmission->send([
    			'from'=>$this->fromEmail,
    			'recipients'=>[
    				[
    					'address'=>['email'=>$this->toEmail]['email'],
    					'substitution_data' => [
    						'urlActivation'=>'<a href="http://mzof.es/finalizar-registro/'.$this->authkey.'">http://mzof.es/finalizar-registro/'.$this->authkey.'</a>',
    						'buttonActivation'=>'<a href="http://mzof.es/finalizar-registro/'.$this->authkey.'" style="text-decoration: none;"><div class="button_allOffers" style="background-color: #ffffff !important;text-decoration:none !important;width:250px;">Activar mi cuenta - clic aquí</div></a>'
    					],
    				]
    			],
    			'template'=>'mzof-es-registration'
    		]);
    		echo 'Congrats you can use your SDK!';
    	} catch (\Exception $exception) {echo $exception->getMessage();}
    }
}
