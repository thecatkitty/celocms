<?php
include('u2a.php');

function mb_toarray($str)
{
	if (mb_strlen($str, 'UTF-8') == 0)
		return array();

	$ret = array();
	$alen = strlen($str);
	$char = '';
	for ($i = 0; $i < $alen; $i++) {
		$char .= $str[$i];
		if (mb_check_encoding($char, 'UTF-8')) {
			array_push($ret, $char);
			$char = '';
		}
	}
	return $ret;
}

function get_ascii_cognate($c)
{
	global $UNICODE_TO_ASCII;

	$cn = IntlChar::ord($c);

	if ($cn < 128)
		return $c;
	if (isset($UNICODE_TO_ASCII[$cn]))
		return $UNICODE_TO_ASCII[$cn];

	$character = IntlChar::charName($cn);
	$cname = $character;
	if ($cname == '')
		return '?';

	// Usuń modyfikacje liter
	$cname = str_replace(array('SUBSCRIPT ', 'SUPERSCRIPT ', 'TURNED ', 'REVERSED ', 'INVERTED ', 'OPEN ', 'CLOSED ', 'DOTLESS ', 'BARRED ', 'SCRIPT ', 'DOUBLE-STRUCK ', 'BLACK-LETTER ', 'SANS-SERIF ', 'FULLWIDTH '), array(''), $cname);
	// Mała wielka litera to wielka litera
	$cname = str_replace('SMALL CAPITAL', 'CAPITAL', $cname);
	// Usuń znaki diakrytyczne
	$cname = preg_replace('/(LETTER [A-Z ]+)( WITH [A-Z ]+)$/', '$1', $cname);
	// Dopisz brakujące elementy nazwy
	$cname = preg_replace('/^(SMALL|CAPITAL) ([A-Z ]+)$/', 'LATIN $1 LETTER $2', $cname);

	// Zwróć kod, jeżeli znak został zdefiniowany
	$n = IntlChar::charFromName($cname);
	if (isset($UNICODE_TO_ASCII[$n]))
		return $UNICODE_TO_ASCII[$n];

	// Jeśli litera alfabetu łacińskiego
	if (preg_match('/^LATIN (SMALL |CAPITAL )?(LETTER|LIGATURE) ([A-Z ]+)/', $cname, $matches))
		return $UNICODE_TO_ASCII[$cn] = (($matches[1] == 'SMALL ') ? strtolower($matches[3]) : $matches[3]);
	// Jeśli litera
	if (preg_match('/(SMALL|CAPITAL) LETTER ([A-Z ]+)/', $cname, $matches))
		return $UNICODE_TO_ASCII[$cn] = (($matches[1] == 'SMALL') ? strtolower($matches[2]) : $matches[2]);
	// Jeśli modyfikator literowy
	if (preg_match('/^MODIFIER LETTER (SMALL |CAPITAL )?([A-Z ]+)/', $cname, $matches))
		return $UNICODE_TO_ASCII[$cn] = (($matches[1] == 'SMALL ') ? strtolower($matches[2]) : $matches[2]);
	// Jeśli znak diakrytyczny
	if ($n >= 0x0300 && $n <= 0x036F)
		return $UNICODE_TO_ASCII[$cn] = '';

	return $UNICODE_TO_ASCII[$cn] = IntlChar::chr($n);
}

function str_remove_diacritics($str)
{
	$str = mb_toarray($str);
	$ret = '';
	foreach ($str as $c)
		$ret .= get_ascii_cognate($c);
	return $ret;
}
?>