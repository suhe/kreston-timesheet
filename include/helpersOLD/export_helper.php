<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function to_excel($query, $filename='exceloutput')
{
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below
     
     $obj =& get_instance();
     
     $fields = $query->field_data();
     if ($query->num_rows() == 0) {
          echo '<p>The table appears to have no data.</p>';
     } else {
          foreach ($fields as $field) {
             $headers .= $field->name . "\t";
          }
     
          foreach ($query->result() as $row) {
               $line = '';
               foreach($row as $value) {                                            
                    if ((!isset($value)) OR ($value == "")) {
                         $value = "\t";
                    } else {
                         $value = str_replace('"', '""', $value);
                         $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
               }
               $data .= trim($line)."\n";
          }
          
          $data = str_replace("\r","",$data);
                         
          header("Content-type: application/x-msdownload");
          header("Content-Disposition: attachment; filename=$filename.xls");
          echo "$headers\n$data";  
     }
}

function to_romawi($str){
	switch($str):
		case '01' : $data='I';break;
		case '02' : $data='II';break;
        case '03' : $data='III';break;
		case '04' : $data='IV';break;
		case '05' : $data='V';break;
		case '06' : $data='VI';break;
        case '07' : $data='VII';break;
		case '08' : $data='VIII';break;
		case '09' : $data='IX';break;
		case '10' : $data='X';break;
        case '11' : $data='XII';break;
		case '12' : $data='XII';break; 		
	endswitch;
	return $data;
}