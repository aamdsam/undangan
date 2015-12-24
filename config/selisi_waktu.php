<?php

/* -------------------------------------------------
 * Fungsi untuk menghitung selisih antara 2 waktu  
 * -------------------------------------------------
 */  
if ( ! function_exists('get_interval_time'))
{
	function get_interval_time($time_1, $time_2)
	{
	    date_default_timezone_set('Asia/Jakarta');
        
		$a = explode(":", $time_1);        
        $b = explode(":", $time_2);           
        
        /* Explode parameter $time_1 */
        $a_hour    = $a[0];
        $a_minutes = $a[1];
        $a_seconds = $a[2];
        
        /* Explode parameter $time_2 */
        $b_hour    = $b[0];
        $b_minutes = $b[1];
        $b_seconds = $b[2];
        
        /* declare result variabel */        
        $c_hour    = NULL;
        $c_minutes = NULL;
        $c_seconds = NULL;
        
       /* -----------------------------------------
        * Pengurangan detik
        * -----------------------------------------
        **/
        if($b_seconds >= $a_seconds)
        {
            $c_seconds = $b_seconds - $a_seconds;
        }
        else
        {
            $c_seconds = ($b_seconds + 60) - $a_seconds;
            $b_minutes--;
        }        
        
       /* -----------------------------------------
        * Pengurangan menit
        * -----------------------------------------
        **/
        if($b_minutes >= $a_minutes)
        {
            $c_minutes = $b_minutes - $a_minutes;
        }
        else
        {
            $c_minutes = ($b_minutes + 60) - $a_minutes;
            $b_hour--;
        }        
        
       /* -----------------------------------------
        * Pengurangan jam
        * -----------------------------------------
        **/
        if($b_hour >= $a_hour)
        {
            $c_hour = $b_hour - $a_hour;
        }
        else
        {
            $c_hour = '-' . ($a_hour - $b_hour);
        }
        
        /* Checking time format */
        if( strlen($c_seconds) == 1) $c_seconds = '0'.$c_seconds;
        if( strlen($c_minutes) == 1) $c_minutes = '0'.$c_minutes;
        if( strlen($c_hour) == 1) $c_hour = '0'.$c_hour;
        
        /* Return result */
        return $c_hour . ':' . $c_minutes . ':' . $c_seconds;
	}
}

function dateRange($start,$end){
        $xdate    =frmDate($start,4);
        $ydate    =frmDate($end,4);
        $xmonth    =frmDate($start,5);
        $ymonth    =frmDate($end,5);
        $xyear    =frmDate($start,6);
        $yyear    =frmDate($end,6);
        // Jika Input tanggal berada ditahun yang sama
        if($xyear==$yyear){
            // Jika Input tanggal berada dibulan yang sama
            if($xmonth==$ymonth){
                $nday=$ydate+1-$xdate;
            } else {
                $r2=NULL;
                $nmonth = $ymonth-$xmonth;            
                $r1 = nmonth($xmonth)-$xdate+1;
                for($i=$xmonth+1;$i<$ymonth;$i++){
                    $r2 = $r2+nmonth($i);
                }
                $r3 = $ydate;
                $nday = $r1+$r2+$r3;
            }
        } else {
            // Jika Input tahun awal berbeda dengan tahun akhir
            $r2=NULL; $r3=NULL;
            $r1=nmonth($xmonth)-$xdate+1;

            for($i=$xmonth+1;$i<13;$i++){
                $r2 = $r2+nmonth($i);
            }
            for($i=1;$i<$ymonth;$i++){
                $r3 = $r3+nmonth($i);
            }
            $r4 = $ydate;
            $nday = $r1+$r2+$r3+$r4;
        }            
        return $nday;
    }

