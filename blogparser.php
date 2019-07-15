<?php

        header('Content-type: application/json');

        $fp    = 'blogpost.txt';

        // Open the file to read data.
		$fh = fopen($fp,'r');
		
		// define an eampty array
		$data = array();

		// read data
		while ($line = fgets($fh)) {
			// if the line has some data
			if(trim($line) != ''){
				// explode each line data 
				$line_data = explode(':',$line);
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
		
		fclose($fh);

	// json encode the array
	echo $json_data = json_encode($data);
?>
