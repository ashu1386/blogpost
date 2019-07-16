<?php

        header('Content-type: application/json');

         // make your required checks

        $fp    = 'blogpost.txt';
		
	// define an eampty array
	$data = array();
		
        // get the contents of file in array
        $conents_arr   = file($fp,FILE_IGNORE_NEW_LINES);
	if(empty($conents_arr)){
		echo "File is empty";
		exit;
	}
        foreach($conents_arr as $key=>$value)
        {			
		if(trim($value) != ''  && strpos($value, ':') !== false){
			// explode each line data 
			$line_data = explode(':',$value,2);
			if(trim($line_data[0]) == 'tags'){
				//seperate data by comma(,) and convert it into array
				$tags_data = explode(',',trim($line_data[1]));
				$data[trim($line_data[0])] = $tags_data;
			}
			else{
				// push data to array
				$data[trim($line_data[0])] = trim($line_data[1]);
			}
		}
        }
		
	// find if READMORE present in array
	$key = array_search("READMORE", $conents_arr);

	if($key){
		//find metakey last position
		$metakey = array_keys($conents_arr,"---"); 
		$lastMetakey = array_pop($metakey) + 1;

		// short content
		for($j = $lastMetakey; $j < $key; $j++){
			$short_content[$j] = $conents_arr[$j];
		}
		$data['short-content'] = implode(" ",$short_content);

		//content 
		$con_key = $key + 1;
		for($i = $con_key; $i < count($conents_arr);$i++){
			$content[$i] = $conents_arr[$i];
		}
		$data['content'] = implode(" ",$content);
	}
		
        $json_contents = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        echo $json_contents;
?>
