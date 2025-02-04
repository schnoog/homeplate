<?php 


if(isset($_FILES['file']['name']))
{	

	$fileName = $_FILES['file']['name'];
	$tempPath = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];

	$upload_path = 'assets/img/icons/';	
	
	$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
	
	$valid_extensions = array('png');
	
	if(in_array($fileExt, $valid_extensions))
	{				
		//check file not exist our upload folder path
		if(!file_exists($upload_path . $fileName))
		{
			// check file size '5MB'
			if($fileSize < 5000000)
			{
				if(move_uploaded_file($tempPath, $upload_path . $fileName)) // move file from system temporary path to our upload folder path 
				{
	

					$success = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> 
									File Uploaded Successfully  
								</div>';
							
					echo json_encode(array('success' => $success));	
				}					
			}
			else
			{		
				$sizeError = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> 
									Sorry, your file is too large, please upload 5 MB size  
							  </div>';
							  
				echo json_encode(array('size_error' => $sizeError));				 
			}
		}
		else
		{		
			$existsError = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> 
								Sorry, file already exists check upload folder  
					        </div>';
							
			echo json_encode(array('exists_error' => $existsError));				 
		}
	}
	else
	{				
		$extensionError = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> 
								Sorry, only JPG, JPEG, PNG, Doc, Docx files are allowed  
						   </div>';
						   
		echo json_encode(array('extension_error' => $extensionError));				 
	}
}