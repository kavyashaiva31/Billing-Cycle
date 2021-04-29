<?php

$a =  readline('Enter the Start date: ');
$b =  readline('Enter the End date: ');
$date = strtotime($a);($b);
function dateRange($firstDate, $lastDate, $step = '+1 day', $format = 'd-m-Y', $period='20' ){
        $dates = array();

        $first  = strtotime($firstDate); 
        $current= strtotime($firstDate);
        $last   = strtotime($lastDate);

        $startSet = $period;
        $endSet = $period - 1;

        $startFormat = "{$startSet}-m-Y";
        $endFormat = "{$endSet}-m-Y";


        $i=0;
        $loopEnd = true;
        while( $current <= $last ){    

            if($first==$current){
                //Start Month

                $dates[$i]['startDate'] = $firstDate;

                $chkStartDay = date("d", $first);
                if($chkStartDay < $period){


                    $dates[$i]['endDate'] = date($endFormat, $current);

                }else{
                    $dates[$i]['endDate'] = date($endFormat, strtotime("+1 month", $current));
                }

                $nextDateEnd = $dates[$i]['endDate'];

            }else{


                $dates[$i]['startDate'] = date("d-m-Y", strtotime("+1 day", strtotime($nextDateEnd)));
                $dates[$i]['endDate'] = date($endFormat, strtotime("+1 month", strtotime($dates[$i]['startDate'])));;   


                if($lastDate < $dates[$i]['endDate']){
                    $dates[$i]['endDate'] = $lastDate;
                    $loopEnd = false;
                }

            }

            $nextDateStart = $dates[$i]['startDate'];
            $nextDateEnd = $dates[$i]['endDate'];

            $current = strtotime($step, $current);

            $i++;
        }


        if($lastDate > date($endFormat, strtotime($lastDate)) and $loopEnd == true ){
            $i++;

            $dates[$i]['startDate'] = date("d-m-Y", strtotime("+1 day", strtotime($nextDateEnd)));
            $dates[$i]['endDate'] = $lastDate; 


        }

        return $dates;
}

$dates = dateRange($a, $b, "+1 month", "d-m-Y", '20');//increase by one month
print_r($dates);

?>