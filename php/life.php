<div id="divLife">
<?php
header('Content-Type: text/html; charset=UTF-8');
$max_x=15; //This is to set board size
$max_y=15;

$arr=array();
$arrStr='';

createBoard($max_x,$max_y,$arr);
createLife($max_x,$max_y,$arr);
print_board($arr,$max_x,$max_y);

for ($i = 0; $i < $max_x; $i++) {
	checkNeighbors($max_x,$max_y,$arr);
}

function print_board(&$arr,$max_x,$max_y){
?>
 <script type="text/javascript">document.getElementById("divLife").innerHTML="";</script>	
<?php
	for($x=0;$x<$max_x;$x++){
		for($y=0;$y<$max_y;$y++){
			echo $arr[$x][$y];
		}
		echo '<br>'; 
	}
}
function createBoard($max_x,$max_y,&$arr){
	for($x=0;$x<$max_x;$x++){
		for($y=0;$y<$max_y;$y++){
			$arr[$x][$y]=htmlspecialchars_decode("&#9633");
		}
	}
	
}

function createLife($max_x,$max_y,&$arr){
	for($x=0;$x<$max_x;$x++){
		for($y=0;$y<$max_y;$y++){
			$x_rand = rand(0, $max_x);
			$y_rand = rand(0, $max_y);
			if($arr[$x_rand][$y_rand]!=htmlspecialchars_decode("&#9632"));
				$arr[$x_rand][$y_rand]=htmlspecialchars_decode("&#9632");
		}
	}
}


function checkNeighbors($max_x,$max_y,&$arr){
	$actNeighbor_cnt =	0;
	for($x=0;$x<$max_x;$x++){
		for($y=0;$y<$max_y;$y++){
			
			$curr_x=$x;
			$curr_y=$y;
			
			for($i=-1;$i<=1;$i++){
				for($j=-1;$j<=1;$j++){
					if(isset($arr[$x+$i][$y+$j]) /*&& ($curr_x.$curr_y!=($x+$i).($y+$j))*/ && $arr[$x+$i][$y+$j]==htmlspecialchars_decode("&#9632")) { //exclude current cell.
						$actNeighbor_cnt++;
						//commented condition is to exlcude current cell from the list of neighbors.
						
						
					}
				}
			}
			
			//Implement Rules
			
			if ($actNeighbor_cnt <= 2 && $arr[$x][$y] == htmlspecialchars_decode("&#9632")) {
				$arr[$x][$y] = htmlspecialchars_decode("&#9633");
			} elseif ($actNeighbor_cnt >= 4 && $arr[$x][$y] == htmlspecialchars_decode("&#9632")) {
				$arr[$x][$y] = htmlspecialchars_decode("&#9633");
			} elseif ($actNeighbor_cnt == 3 && $arr[$x][$y] == htmlspecialchars_decode("&#9632")) {
				$arr[$x][$y] = htmlspecialchars_decode("&#9632");
			} elseif ($actNeighbor_cnt == 3 && $arr[$x][$y] == htmlspecialchars_decode("&#9633")) {
				$arr[$x][$y] = htmlspecialchars_decode("&#9632");
			} else if ($arr[$x][$y] == htmlspecialchars_decode("&#9633")) {
				$arr[$x][$y] = htmlspecialchars_decode("&#9633");
			}
				
			$actNeighbor_cnt=0;
		}
	}

	callSleep();
	print_board($arr,$max_x,$max_y);
}

function callSleep()
{
	flush();
	ob_flush();
	sleep(1);
}

?>
</div>
