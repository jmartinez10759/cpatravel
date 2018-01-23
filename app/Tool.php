<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    public static function RemplaceText($cadena){
        $letras = [ "à","ä","â","ª","À","Â","Ä",
                    "d","o","è","ë","ê","É","È",
                    "Ê","Ë","ì","ï","î","Í","Ì",
                    "Ï","Î","i","ò","ö","ô","Ó",
                    "Ò","Ö","Ô","ù","ü","û","Ú",
                    "Ù","Û","Ü","ç","Ç",",",'¨',
                    '"',"º","-","~","#","@","|",
                    "!",",","·","$","%","&","/",
                    "(",")","?","¡","¿","[","^",
                    "</code>","]","+","}","{","¨","*","=","'",
                    "´",">","<"," ",";",",",":",".","_"
                    ];
        $onlyconsonants = str_replace($letras, "", $cadena);
        return $onlyconsonants;
    }

    public static function dateFormat($date){
        $explodedate = explode('/',$date);
        return $dateFormat = $explodedate[2].'-'.$explodedate[0].'-'.$explodedate[1];
    }
}
