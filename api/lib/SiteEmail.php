<?php
class SiteEmail{
	public static function getRecord($key){
		global $CFG;
		
		$key = preg_replace("/[^0-9a-zA-Z!@#$%&*?\.\-_]/", "",$key);
		
		if (empty($key))
			return false;		
		$sql="SELECT * FROM emails WHERE emails.key='$key' ";	
		$result = db_query_array($sql);
		
		$result[0]['title'] = ($CFG->language == 'en' && !empty($result[0]['title_en'])) ? $result[0]['title_en']: $result[0]['title_es'];
		$result[0]['content'] = ($CFG->language == 'en' && !empty($result[0]['content_en'])) ? $result[0]['content_en']: $result[0]['content_es'];
		$result[0]['title'] = str_replace('[exchange_name]',$CFG->exchange_name,$result[0]['title']);
		$result[0]['content'] = str_replace('[exchange_name]',$CFG->exchange_name,$result[0]['content']);
		return $result[0];
	}
	
	public static function emailExists($email) {
		$sql = "SELECT * FROM mailing_list WHERE email = '$email' ";
		$result = db_query_array($sql);
		return ($result);
	}
	
	public static function getCountry($country_id) {
		return DB::getRecord('iso_countries',$country_id,0,1);
	}
	
	public static function contactForm($contact_info) {
		global $CFG;
		
		$email = SiteEmail::getRecord('contact');
		$pais = SiteEmail::getCountry($contact_info['country']);
		$contact_info['country'] = $pais['name'];

		if (User::$info['id'] > 0)
			$contact_info['user_id'] = User::$info['id'];
		
		return Email::send($contact_info['email'],'contact@1btcxe.com',$email['title'],$CFG->form_email_from,false,$email['content'],$contact_info);
	}
}
?>