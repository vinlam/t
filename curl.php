<?php
$url = $_POST['url'];
$data = $_POST['data'];
CurlUtils::send($url,$data);
Class CurlUtils{
	public static function send($url,$data){
		if(!$url)
			exit('url can not be null');
		
		$ch = curl_init($url);
		//初始化curl
		$urlArr = parse_url($url);
		$oriUrl = $urlArr['scheme'].'://'.$urlArr['host'];
		$headers[] = 'Content-Type:application/json;charset=UTF-8';
		$headers[] = 'Accept:application/json';
		
		curl_setopt_array($ch,
			array(
				CURLOPT_HEADER =>false,
				CURLOPT_HTTPHEADER =>$headers,
				CURLOPT_AUTOREFERER =>true,
				CURLOPT_RETURNTRANSFER =>true,
				CURLOPT_REFERER =>true,
				CURLOPT_TIMEOUT =>30  //,
				//CURLOPT_COOKIE =>'cpc_auth='.$_COOKIE['cpc_auth'],
			)
		);
		
		if(!empty($data){
			curl_setopt_array($ch,array(CURLOPT_POST => 1,CURLOPT_POSTFIELDS => $data));
		}else{
			echo 'fail:'.$data;
		}
		
		$rtdata = curl_exec($ch);//执行curl
		curl_close($ch); //关闭curl
		return json_decode($rtdata);
	}
}
?>