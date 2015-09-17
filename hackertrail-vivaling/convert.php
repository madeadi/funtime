<?php

function convert($dict, $str){
	// make all as small characters
	$str2 = strtolower(trim($str));

	// translate one by one
	for($i=0; $i <= 2; $i++){
		for($j=0; $j < strlen($str2); $j++){
			$ascii = ord(substr($str2, $j, 1));
			if($ascii == 32){
				// if a space
				echo "  ";
			} else if($ascii >= 97 && $ascii <= 122){
				// if a-z
				echo $dict[$ascii - 97][$i];
				if(strlen($dict[$ascii - 97][$i]) > 0 && $j != (strlen($str2)-1)){
					echo " ";
				}
			}
		}
		echo PHP_EOL;
	}
}

function formDict(){
    $row1 = ' __   __   __  __   __  __  __          _                    __   __   __   __  ___               __';
    $row2 = '|__| |__\ |   |  \ |_  |_  | _  |__| |  | |_/ |   |\/| |\ | |  | |__| |__| |__   |  |  | |  | \_/  /';
    $row3 = '|  | |__/ |__ |__/ |__ |   |__| |  | | _| | \ |__ |  | | \| |__| |    | \   __|  |  |__| |/\|  |  /_';
    $leng = array(4,   4,   3,  4,   3,  3,   4,   4,  1,2, 3,  3,   4,  4,   4,   4,0, 4,   4,   3,  4,0, 4,0, 3,  2);

    // form the dictionary
    $dict = array();
    $sum = 0;
    for($i=0; $i < sizeof($leng); $i++){
        if($leng[$i] <= 0){
            // because there's no letter q and v and x
            $dict[$i][0] = "";
            $dict[$i][1] = "";
            $dict[$i][2] = "";
        } else {
            $dict[$i][0] = substr($row1, $sum, $leng[$i]);
            $dict[$i][1] = substr($row2, $sum, $leng[$i]);
            $dict[$i][2] = substr($row3, $sum, $leng[$i]);
            $sum = $sum + $leng[$i] + 1; // plus 1 to compensate the space in the $row
        }
    }

    return $dict;
}

/**
 * Generate a flipped dictionary
 */
function flip($dict){
    $flipDict = array();
    // flip each character
    for($i=0; $i < sizeof($dict); $i++){
        for($j = 0; $j < 3; $j++){
            $content = "";
            for($k=0; $k < strlen($dict[$i][$j]); $k++){
                if($dict[$i][$j][$k] == "\\"){
                        $content .= "/";
                } else if($dict[$i][$j][$k] == "/"){
                        $content .= "\\";
                } else {
                        $content .= $dict[$i][$j][$k];
                }
            }
            $flipDict[$i][$j] = strrev($content);
        }
    }

    return $flipDict;
}

$dict = formDict();
$flippedDict = flip($dict);

while (true) {
    $input = fgets(STDIN);
    if ($input == "0") {
        break;
    } else {
        $direction = substr($input, 0, 1);
        if($direction == "0" || $direction == 0){
            break;
        }

        $str = substr($input, 2);

        if($direction == "2" || $direction == 2){
            $str = strrev($str);
            convert($flippedDict, $str);
        } else if($direction == "1" || $direction == 1){
            convert($dict, $str);
        }


    }
}
