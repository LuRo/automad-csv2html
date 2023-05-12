<?php
/**
 *	iSeek Csv to HTML
 *
 * 	An Automad Csv to HTML convertion extension.
 *
 * 	@author Lukas Rothe
 * 	@copyright Copyright (C) 2023 Lukas Rothe - <https://iseek.ch> 
 * 	@license MIT license
 */

 namespace Iseek\Csv2Html;

 defined('AUTOMAD') or die('Direct access not permitted!');
 
 
 class Csv2Html {

    /**
	 *  The main function.
	 *
	 * 	@param array $options
	 * 	@param object $Automad
	 * 	@return string the output of the extension
	 */
	
	public function Csv2Html($options, $Automad) {

        $str_line_separator = "#";
        $str_cell_separator = ";";

     
        $row = 1;
        if (strlen($options['rawText']) > 0) {

            $hasHeader = $options['hasHeader'];
            $text = $options['rawText'];

            $table_rows = explode($str_line_separator, $text);
            $htmlval = "<table class='table'>";
            $num_rows = count($table_rows);

            for ($table_row=0; $table_row < $num_rows; $table_row++){
                $row_data = str_getcsv($text, $str_cell_separator);

                /* if param hasHeader is true then create header  */
                if ($hasHeader == true){
                    $htmlval = $htmlval. "\n<thead>";
                } else {
                    $htmlval = $htmlval. "\n<tbody>";
                }

                $htmlval = $htmlval."<tr>";
                $num_cells = count($row_data);        
                $row++;
                for ($table_cell=0; $table_cell < $num_cells; $table_cell++) {
                    if($row_data[$table_cell] != "" || trim($row_data[$table_cell]) != " "){
                        if ($hasHeader == true) {
                            // header row
                            $htmlval = $htmlval. "<th class='cols' align='center'>".$row_data[$table_cell]."</th>\n";
                        } else {
                            // table data rows
                            $htmlval = $htmlval. "<td class='cols' align='center'>".$row_data[$table_cell]."</td>\n";
                        }
                    }else{
                        $htmlval = $htmlval. "<td class='cols'>&nbsp;</td>";
                    }
                }
                $htmlval = $htmlval."</tr>";
                if ($hasHeader == true){
                    $htmlval = $htmlval. "\n</thead>";
                } else {
                    $htmlval = $htmlval. "\n</tbody>";
                }
            }
            $htmlval = $htmlval."</table>";
        }

        return $htmlval;
    }
}
