<?php
class ExportPHP
{
 // method for Excel file
    function setHeaderXLS($file_name)
       {
       header("Content-type: application/ms-excel");
       header("Content-Disposition: attachment; filename=$file_name");
       header("Pragma: no-cache");
       header("Expires: 0");
       }
 // method for Doc file
    function setHeaderDoc($file_name)
       {
       header("Content-type: application/x-ms-download");
       header("Content-Disposition: attachment; filename=$file_name");
       header('Cache-Control: public'); 
       }
 // method for CSV file
    function setHeaderCSV($file_name)
       {
        header("Content-type: application/csv");
        header("Content-Disposition: inline; filename=$file_name"); 
        }
    function exportWithQuery($qry,$file_name,$type)
        {
         $tmprst=pg_query($qry);
         $header='<center><table width="100%">';
         $num_field=pg_num_fields($tmprst);
         while($row=pg_fetch_array($tmprst))
              {
                $body.="<tr>";
                for($i=0;$i<$num_field;$i++)
                      $body.="<td>".$row[$i]."</td>";
                $body.="</tr>"; 
              }
         if($type=='xls')
                $this->setHeaderXLS($file_name);
         else if($type=='doc')
                $this->setHeaderDoc($file_name);
         else if($type=='csv')
                $this->setHeaderCSV($file_name);
         echo $header.$body."</table>";
         }
}
?>