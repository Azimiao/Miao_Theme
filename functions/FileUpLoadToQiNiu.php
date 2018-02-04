<?php

/**

 * 

 * @authors Yetu (admin@azimiao.com)

 * @date    2017-09-15 19:51:28

 * @version 1.0

 */



require_once TEMPLATEPATH . '/functions/qiniu/autoload.php';



use Qiniu\Auth;

use Qiniu\Storage\UploadManager;



class FileUpLoadToQN

{



	private $accessKey = null;

	private $secretKey = null;





	function __construct($accesskey,$secretkey) {

       $this->accessKey = $accesskey;

       $this->secretKey = $secretkey;

       

   }





   function GetUpLoadToken($bucket)

   {

   		$auth = new Auth($this->accessKey,$this->secretKey);

   		$token = $auth->uploadToken($bucket);

   		return $token;

   }



	function UpLoadFile($myFileName,$myFilePath,$myBucketName,$myFileType="application/octet-stream")

	{

		//获取uptoken

		$token = $this->GetUpLoadToken($myBucketName);

		//echo $token;

	 	if ($myFileName != null && $myFilePath != null) 

	 	{

			$uploadMgr = new UploadManager();

			

			list($ret,$err) = $uploadMgr->putFile($token,$myFileName,$myFilePath,null,$myFileType,false);



			if ($err !== null) {

				var_dump($err);

			}else

			{

				var_dump($ret);

			}



			return $err;

		}



		return null;

	}

}



?>