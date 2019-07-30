<?php

    function get_arc_meta($filename) {
        $header;
        $content = file_get_contents($filename);
        $BOC = strpos($content, "<!-- var arcMeta"); // Beginning of Comment
        $EOC = strpos($content, "-->");              // End of Comment
        if ( ($BOC !== false) && ($EOC !== false) ) {
            $x = substr($content, $BOC+16, $EOC-16 ); //TODO: WHY -16?? Soft-code
            $header = json_decode($x, true);
        }
        return($header);
    }

    /* DEPRECATED
    // FileRead
    // Reads the data from a file and parses its header, picture, subtitle, and text.
    function fileRead($id, $maxLines) {
        if(!isset($id)) {
            echo "<p>No id index value to compare, please contact 
            elijahtrose@gmail.com.</p>";
        } else if ( !file_exists("../Archive/arc-".$id.".txt") ) {
            echo "<p>Invalid ID Number, index out of bounds, please contact 
            elijahtrose@gmail.com.</p>";
        } else {
            $line; $EOL = "\n"; $EOLCR = "\r\n"; $bNewLine;
            $fo = fopen("../Archive/arc-".$id.".txt", "r");
            $file = array();
            for ($i=0; $i < 3; $i++) {
                $file[$i] = fgets($fo,512);
            } 
            $file[3] = array(); $i=0;
            while ( (!feof($fo)) && ($i < $maxLines) )  { 
                $file[3][$i] = fgets($fo, 512); 
                $i++;
                // $bNewLine = ($line == $EOL) || ($line == $EOLCR);
                // echo ( $bNewLine ? '</p><p>' : '<span>' ).$line.'</span>';
            }
            fclose($fo);
            return ($file);
        }
    }*/
?>