<?php

/**

 *	Csv to HTML table
 *
 * 	An Automad Csv to HTML table convertion extension.
 *  This version aims to support the bootstrap framework.
 *
 * 	@author Lukas Rothe
 * 	@copyright Copyright (C) 2023 Lukas Rothe - <https://iseek.ch> 
 * 	@license MIT license
 */

 namespace LuRo;

 defined('AUTOMAD') or die('Direct access not permitted!'); 

 class Csv2Html {
    /**

	 *  The main function.
	 *
	 * 	@param array $options
	 * 	@param object $Automad
	 * 	@return string the output of the extension
	 */	

	public function Csv2Html( $options ) {

        $str_line_separator = "#";
        $str_cell_separator = ";";     

        $row = 1;

        if (strlen($options['rawText']) > 0) {

            $hasHeader = $options['hasHeader'];
            $text = $options['rawText'];
            
            $cssTheadClass = $options["cssTheadClass"];
            if ($cssTheadClass != "") {$cssTheadClass = " class=".$cssTheadClass."' ";};
            
            $cssTableClass = $options["cssTableClass"];
            if ($cssTableClass != "") {
                $cssTableClass = " class='table ".$cssTableClass."' ";
            } else {
                $cssTableClass = " class='table' ";
            };

            $table_rows = explode($str_line_separator, $text);

            $htmlval = "<table ".$cssTableClass.">";

            $num_rows = count($table_rows);

            \Automad\Core\Debug::log($options['hasHeader'], "Value of hasHeader option");
            \Automad\Core\Debug::log($options['rawText'], "Content of rawText option");
            \Automad\Core\Debug::log($options['cssTableClass'], "Content of cssTableClass option");
            \Automad\Core\Debug::log($options['cssTheadClass'], "Content of cssTheadClass option");


            for ($table_row=0; $table_row < $num_rows; $table_row++){

                $row_data = str_getcsv($table_rows[$table_row], $str_cell_separator);

                /* if param hasHeader is true then create header  */
                if ($hasHeader == true && $table_row == 0){
                    $htmlval = $htmlval. "\n<thead".$cssTheadClass.">";
                } elseif (($hasHeader == true && $table_row == 1) || $hasHeader == false && $table_row == 0) {
                    $htmlval = $htmlval. "\n<tbody>";
                }

                //Start new table row
                $htmlval = $htmlval."<tr>";

                $num_cells = count($row_data);
                $row++;

                for ($table_cell=0; $table_cell < $num_cells; $table_cell++) {

                    if($row_data[$table_cell] != "" || trim($row_data[$table_cell]) != " "){
                        if ($hasHeader == true && $table_row == 0) {
                            // header row
                            $htmlval = $htmlval. "<th scope='cols'>".$row_data[$table_cell]."</th>\n";
                        } else {
                            // table data rows
                            $htmlval = $htmlval. "<td class='cols'>".$row_data[$table_cell]."</td>\n";
                        }
                    } else {
                        $htmlval = $htmlval. "<td class='cols'>&nbsp;</td>";
                    }
                }

                //Close table row
                $htmlval = $htmlval."</tr>";

                //Close table block
                if ($hasHeader == true && $table_row == 0){
                    $htmlval = $htmlval. "\n</thead>";
                } elseif ($row == $num_rows-1) {
                    $htmlval = $htmlval. "\n</tbody>";
                }
            }
            //Close table
            $htmlval = $htmlval."</table>";
        }
        \Automad\Core\Debug::log($htmlval, "Content of return variable (htmlval)");
        return $htmlval;
    }
}

