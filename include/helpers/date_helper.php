<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
    
function day($tgl)
  {  
     $tanggal = substr($tgl,8,2);   
     return $tanggal;         
  }
  
  function num($tgl)
  {  
     $tanggal = substr($tgl,9,1);   
     return $tanggal;         
  }
  
  
  function month($tgl)
  {  
     $tanggal = substr($tgl,8,2);  
     $bulan = substr($tgl,5,2);    
     return $bulan;         
  }
  
  function year($tgl)
  {    
     $tahun = substr($tgl,0,4);  
     return $tahun;         
  }
      
 function indo_tgl($tgl)
  {  
     $tanggal = substr($tgl,8,2);  
     $bulan = getBulan(substr($tgl,5,2));  
     $tahun = substr($tgl,0,4);  
     return $tanggal.' '.$bulan.' '.$tahun;         
  }     
  
  function indo_tgl_time($tgl)
    {  
      $tanggal = substr($tgl,8,2);  
      $bulan = getBulan(substr($tgl,5,2));  
      $tahun = substr($tgl,0,4);  
      $jam = substr($tgl,11,2);  
      $menit = substr($tgl,14,2);  
      return $tanggal.' '.$bulan.' '.$tahun.' '.$jam.':'.$menit.' WIB' ;        
        
    }  
        
  function getBulan($bln)
  {  
                   switch ($bln){  
                   case 1:   
                   return "Januari";  
                          break;  
                   case 2:  
                   return "Februari";  
                          break;  
                       case 3:  
                           return "Maret";  
                           break;  
                       case 4:  
                           return "April";  
                           break;  
                      case 5:  
                           return "Mei";  
                          break;  
                      case 6:  
                           return "Juni";  
                          break;  
                      case 7:  
                          return "Juli";  
                          break;  
                      case 8:  
                          return "Agustus";  
                          break;  
                      case 9:  
                          return "September";  
                          break;  
                      case 10:  
                          return "Oktober";  
                          break;  
                      case 11:  
                          return "November";  
                           break;  
                       case 12:  
                           return "Desember";  
                          break;  
                   }  
  }
  
  function daydata($day,$mn)
  {
       $sql="SELECT DAY(date_h) as day FROM josh_holiday WHERE DAY(date_h)='$day' AND MONTH(date_h)='$mn' AND YEAR(date_h)='2010'"; 
       $exe=mysql_query($sql);
       $rec2=mysql_fetch_array($exe);
       echo $rec2['day'];
  } 
  
 function selisih($jam_masuk,$jam_keluar) {
	if(($jam_masuk!='') && ($jam_keluar!='')) {
		list($h,$m,$s) = explode(":","00:00:00");
		$dt0 = mktime($h,$m,$s,"1","1","1");
		list($h,$m,$s) = explode(":","24:00:00");
		$dt = mktime($h,$m,$s,"1","1","1");
		list($h,$m,$s) = explode(":",$jam_masuk);
		$dtAwal = mktime($h,$m,$s,"1","1","1");
		list($h,$m,$s) = explode(":",$jam_keluar);
		$dtAkhir = mktime($h,$m,$s,"1","1","1");
		$dtSelisih = $dtAkhir-$dtAwal;

		if($dtSelisih < 0) {
			$dtSelisih1=($dt - $dtAwal);
			$dtSelisih2=($dtAkhir - $dt0);
			$dtSelisih=$dtSelisih1+$dtSelisih2;
		}

		$totalmenit=$dtSelisih/60;
		$jam =explode(".",$totalmenit/60);
		$sisamenit=($totalmenit/60)-$jam[0];
		$sisamenit2=$sisamenit*60;
		$jml_jam=$jam[0];
		return $jml_jam;
	} else {
		return $jml_jam=0;
	}
}


function mysqldate($date){
		return preg_replace('!(\d+)/(\d+)/(\d+)!', '\3-\2-\1', $date);
	}