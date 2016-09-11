<?php
class MailPear {
	protected $to;
	protected $from;
	protected $sender;
	protected $reply_to;
	protected $subject;
	protected $text;
	protected $html;
	protected $attachments = array();
	public $protocol = 'mail';
	public $smtp_hostname;
	public $smtp_username;
	public $smtp_password;
	public $smtp_port = 25;
	public $smtp_timeout = 5;
	public $newline = "\n";
	public $verp = false;
	public $parameter = '';

	public function __construct($config = array()) {
		foreach ($config as $key => $value) {
			$this->$key = $value;
		}
	}

	public function setTo($to) {
		$this->to = $to;
	}

	public function setFrom($from) {
		$this->from = $from;
	}

	public function setSender($sender) {
		$this->sender = $sender;
	}

	public function setReplyTo($reply_to) {
		$this->reply_to = $reply_to;
	}

	public function setSubject($subject) {
		$this->subject = $subject;
	}

	public function setText($text) {
		$this->text = $text;
	}

	public function setHtml($html) {
		$this->html = $html;
	}

	public function addAttachment($filename) {
		$this->attachments[] = $filename;
	}

	public function send(){
		$headers = "From: " . $this->from . "\r\n";
		$headers .= "To: ". $this->to . "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$subject = $this->subject;
		
		if($this->html != ''){
			$headers.="Content-type: text/html; charset=\"utf-8\"\r\n";
			$msg = $this->html;
		}else{
			$headers.="Content-type: text/plain; charset=\"utf-8\"\r\n";
			$msg = $this->text;
		}

		mail($this->to, $subject, $msg, $headers);

	}
}