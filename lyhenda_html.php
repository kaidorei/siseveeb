<?
	$ent_iso_8859_1 = array(
         "nbsp", "iexcl", "cent", "pound", "curren", "yen", "brvbar",
         "sect", "uml", "copy", "ordf", "laquo", "not", "shy", "reg",
         "macr", "deg", "plusmn", "sup2", "sup3", "acute", "micro",
         "para", "middot", "cedil", "sup1", "ordm", "raquo", "frac14",
         "frac12", "frac34", "iquest", "Agrave", "Aacute", "Acirc",
         "Atilde", "Auml", "Aring", "AElig", "Ccedil", "Egrave",
         "Eacute", "Ecirc", "Euml", "Igrave", "Iacute", "Icirc",
         "Iuml", "ETH", "Ntilde", "Ograve", "Oacute", "Ocirc", "Otilde",
         "Ouml", "times", "Oslash", "Ugrave", "Uacute", "Ucirc", "Uuml",
         "Yacute", "THORN", "szlig", "agrave", "aacute", "acirc",
         "atilde", "auml", "aring", "aelig", "ccedil", "egrave",
         "eacute", "ecirc", "euml", "igrave", "iacute", "icirc",
         "iuml", "eth", "ntilde", "ograve", "oacute", "ocirc", "otilde",
         "ouml", "divide", "oslash", "ugrave", "uacute", "ucirc",
         "uuml", "yacute", "thorn", "yuml"
	); 
	function to_keys($a) {
		for ($i = 0;$i<count($a);$i++) {
			$tagasi[strtolower($a[$i])] = 1;
		}
		return $tagasi;
	}
	function is_entity($s) {
		global $ent_iso_8859_1;
		$a = $ent_iso_8859_1;
		for ($i = 0;$i<count($a);$i++) {
			if ("&".$a[$i].";" == $s) return true;
		}
		return false;
	}	  
	function ritta($a,$ind) {
		$temp = "";
		for ($i = $ind;$i>0;$i--) {
			$temp = $temp."</".$a[$i].">\n";
		}
		return $temp;
	}
	function lyhenda ($s = "",$limit = 300) {
		$lubatud = array("a" => 1, "strong" => 1, "img" => 0, "p" => 1, "b" => 1, "em" => 1, "br" => 0, "i" => 1);
		if (strlen($s) < $limit) return $s;
		$tekst = strip_tags($s,"<a><img><p><b><i><strong><br><em>");
		$link = false;
		$amp_char_begin = 0;
		$amp_char_end = 0;
		$amp_char_len = 0;
		$algus[0] = "";
		$j = $limit;
		$ind = 0;
		for ($i = 0;$i<strlen($tekst);$i++) {
			if ($limit < 1) {
				if ($amp_char_begin != 0) $i = $amp_char_begin;	
				$ret = substr($tekst,0,$i);
				if ($ind > 0) return $ret."...".ritta($algus,$ind);
				else return $ret;
			}
			if ($tekst{$i} == "<") {
				if ($tekst{$i+1} == "/") {
					$algus[$ind] = "";
					$ind = $ind - 1;
				}
				else {
					$tag = "";
					for ($k = $i+1;$k<$i+10;$k++){
						if ($tekst{$k} == ">" || $tekst{$k} == " ") {
							$k = $i + 10;
							continue;
						}
						$tag = $tag.$tekst{$k};
					}
					if ($lubatud[strtolower($tag)]) {
						$ind++;
						$algus[$ind] = $tag;
					}				
				}
				$link = true;
			}
			if ($tekst{$i} == ">") {
				$link = false;
			}
			if (!$link) {
				if ($tekst{$i} == "&") {
					$amp_char_begin = $i;
					$amp_char_len = 0;
					for ($a = 0;$a<10;$a++) {
						if ($tekst{$i + $a} == ";") {
							$amp_char_len = $a;
							break;
						}
					}
					if ($amp_char_len == 0) $amp_char_begin = 0;
					else {
						if (!is_entity(substr($tekst,$amp_char_begin,$amp_char_len + 1))) {
							$amp_char_begin = 0;
							$amp_char_len = 0;
						}
					}
				}
				if ($amp_char_len > 0) {	
					if ($amp_char_begin + $amp_char_len < $i) {
						$amp_char_begin = 0;
						$amp_char_len = 0;
					}
				}
				$limit = $limit - 1;
			}
		}
		return $tekst;
	}
?>