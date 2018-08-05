<?php 
	function saveInvoice($file,$event_id)
	{
		if($file['invoice_file']['error'] > 0)
				return false;
		else{
			$uploadsDir = 'uploads/invoices/'.$event_id;
			$date = new DateTime();
			$filename = $date->format('Ymd').'_'.$file['invoice_file']['name'];

			if(!file_exists($uploadsDir))
				mkdir($uploadsDir, 0777);
			$openDir = opendir($uploadsDir);
			$fileDir = $uploadsDir.'/'.$filename;

			if(move_uploaded_file($file['invoice_file']['tmp_name'],$fileDir)){
				closedir($openDir);
				return $fileDir;
			}
			else{
				closedir($openDir);
				return false;
			}

		}
	}

	function saveProfilePic($file, $person_id)
	{
		if($file['profilePic']['error'] > 0)
				return false;
		else{
			$uploadsDir = 'uploads/profile/'.$person_id;
			$date = new DateTime();
			$filename = $date->format('Ymd').'_'.$file['profilePic']['name'];

			if(!file_exists($uploadsDir))
				mkdir($uploadsDir, 0777);
			
			$openDir = opendir($uploadsDir);
			$fileDir = $uploadsDir.'/'.$filename;

			if(move_uploaded_file($file['profilePic']['tmp_name'],$fileDir)){
				closedir($openDir);
				return $fileDir;
			}
			else{
				closedir($openDir);
				return false;
			}
		}
	}

	function saveDocument($file, $person_id)
	{
		
	}





 ?>