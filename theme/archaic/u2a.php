<?php
$UNICODE_TO_ASCII = array(
    // Latin-1 Supplement
	0x00A0 => ' ', '!', 'cent', 'pound', '?', 'yen', '|', 'sect', '?', '(C)', 'a', '&lt;&lt;', '~', ' ', '(R)', '?',
	          'deg', '+-', '^2', '^3', '\'', 'micro', '?', '.', ',', '^1', 'o', '&gt;&gt;', '1/4', '1/2', '1/4', '?',
    0x00C6 => 'AE', 0x00D0 => 'DH', 0x00D7 => 'x', 0x00DE => 'TH', 'ss',
	0x00E6 => 'ae', 0x00F0 => 'dh', 0x00F7 => '/', 0x00FE => 'th',
	// Latin Extended-A
	0x0131 => 'i', 0x0138 => 'q', 0x014A => 'NG', 'ng', 0x017F => 's',
	// Latin Extended-B
	0x01F2 => 'Dz',
	// 0250—02AF IPA Extensions 
    // 02B0—02FF Spacing Modifier Letters 
	0x02B9 => '\'', '"', '\'', '\'', '\'',
    // 0300—036F Combining Diacritical Marks 
    // 0370—03FF Greek and Coptic 
    // 0400—04FF Cyrillic 
    // 0500—052F Cyrillic Supplement 
    // 0530—058F Armenian 
    // 0590—05FF Hebrew 
    // 0600—06FF Arabic 
    // 0700—074F Syriac 
    // 0750—077F Arabic Supplement 
    // 0780—07BF Thaana 
    // 07C0—07FF NKo 
    // 0800—083F Samaritan 
    // 0840—085F Mandaic 
    // 08A0—08FF Arabic Extended-A 
    // 0900—097F Devanagari 
    // 0980—09FF Bengali 
    // 0A00—0A7F Gurmukhi 
    // 0A80—0AFF Gujarati 
    // 0B00—0B7F Oriya 
    // 0B80—0BFF Tamil 
    // 0C00—0C7F Telugu 
    // 0C80—0CFF Kannada 
    // 0D00—0D7F Malayalam 
    // 0D80—0DFF Sinhala 
    // 0E00—0E7F Thai 
    // 0E80—0EFF Lao 
    // 0F00—0FFF Tibetan 
    // 1000—109F Myanmar 
    // 10A0—10FF Georgian 
    // 1100—11FF Hangul Jamo 
    // 1200—137F Ethiopic 
    // 1380—139F Ethiopic Supplement 
    // 13A0—13FF Cherokee 
    // 1400—167F Unified Canadian Aboriginal Syllabics 
    // 1680—169F Ogham 
    // 16A0—16FF Runic 
    // 1700—171F Tagalog 
    // 1720—173F Hanunoo 
    // 1740—175F Buhid 
    // 1760—177F Tagbanwa 
    // 1780—17FF Khmer 
    // 1800—18AF Mongolian 
    // 18B0—18FF Unified Canadian Aboriginal Syllabics Extended 
    // 1900—194F Limbu 
    // 1950—197F Tai Le 
    // 1980—19DF New Tai Lue 
    // 19E0—19FF Khmer Symbols 
    // 1A00—1A1F Buginese 
    // 1A20—1AAF Tai Tham 
    // 1AB0—1AFF Combining Diacritical Marks Extended 
    // 1B00—1B7F Balinese 
    // 1B80—1BBF Sundanese 
    // 1BC0—1BFF Batak 
    // 1C00—1C4F Lepcha 
    // 1C50—1C7F Ol Chiki 
    // 1C80—1C87 Cyrillic Extended C 
    // 1CC0—1CCF Sundanese Supplement 
    // 1CD0—1CFF Vedic Extensions 
    // 1D00—1D7F Phonetic Extensions 
    // 1D80—1DBF Phonetic Extensions Supplement 
    // 1DC0—1DFF Combining Diacritical Marks Supplement 
    // 1E00—1EFF Latin Extended Additional 
    // 1F00—1FFF Greek Extended 
    // 2000—206F General Punctuation 
	0x2010 => '-', '-', '-', '-', '-', '-', '||', 0x2018 => '\'', '\'', '\'', '\'', '"', '"', '"', '"',
	0x2024 => '.', '..', '...',
	0x2032 => '\'', '\'\'', '\'\'\'', 0x2039 => '&lt;', '&gt;', 0x203C => '!!', '!?',
	0x2047 => '??', '?!', '!?',
	0x2057 => '\'\'\'\'',
    // 2070—209F Superscripts and Subscripts 
    // 20A0—20CF Currency Symbols 
	0x20A0 => 'CE', 'C', 'Cr', 'F', 'L', 'm', 'N', 'Pts', 'Rs', 'W',  'sheq.', 'd', 'Euro', 'K', 'T', 'Dp',
	          'Pf.', 'P', 'G', 'A', 'Hryv.', 'C', 'lt', 'Sm', 'T',
    // 20D0—20FF Combining Diacritical Marks for Symbols 
    // 2100—214F Letterlike Symbols 
	0x2100 => 'a/c', 'a/s', 'C', 'deg. C', 'CL', 'c/o', 'c/u', 0x2109 => 'deg. F',
	0x2114 => 'LB', 0x2116 => 'No', '(P)', 0x211E => 'Px', 'R',
	          '(SM)', 'TEL', '(TM)', 'V',
    0x2139 => 'i', 0x213B => 'FAX', 0x214D => 'A/S',
    // 2150—218F Number Forms 
	0x2150 => '1/7', '1/9', '1/10', '1/3', '2/3', '1/5', '2/5', '3/5', '4/5', '1/6', '5/6', '1/8', '3/8', '5/8', '7/8', '1/',
	          'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII', 'L', 'C', 'D', 'M',
			  'i', 'ii', 'iii', 'iv', 'v', 'vi', 'vii', 'viii', 'ix', 'x', 'xi', 'xii', 'l', 'c', 'd', 'm',
    // 2190—21FF Arrows 
    // 2200—22FF Mathematical Operators 
    // 2300—23FF Miscellaneous Technical 
    // 2400—243F Control Pictures 
    // 2440—245F Optical Character Recognition 
    // 2460—24FF Enclosed Alphanumerics 
    // 2500—257F Box Drawing 
    // 2580—259F Block Elements 
    // 25A0—25FF Geometric Shapes 
    // 2600—26FF Miscellaneous Symbols 
    // 2700—27BF Dingbats 
    // 27C0—27EF Miscellaneous Mathematical Symbols-A 
    // 27F0—27FF Supplemental Arrows-A 
    // 2800—28FF Braille Patterns 
    // 2900—297F Supplemental Arrows-B 
    // 2980—29FF Miscellaneous Mathematical Symbols-B 
    // 2A00—2AFF Supplemental Mathematical Operators 
    // 2B00—2BFF Miscellaneous Symbols and Arrows 
    // 2C00—2C5F Glagolitic 
    // 2C60—2C7F Latin Extended-C 
    // 2C80—2CFF Coptic 
    // 2D00—2D2F Georgian Supplement 
    // 2D30—2D7F Tifinagh 
    // 2D80—2DDF Ethiopic Extended 
    // 2DE0—2DFF Cyrillic Extended-A 
    // 2E00—2E7F Supplemental Punctuation 
    // 2E80—2EFF CJK Radicals Supplement 
    // 2F00—2FDF Kangxi Radicals 
    // 2FF0—2FFF Ideographic Description Characters 
    // 3000—303F CJK Symbols and Punctuation 
    // 3040—309F Hiragana 
    // 30A0—30FF Katakana 
    // 3100—312F Bopomofo 
    // 3130—318F Hangul Compatibility Jamo 
    // 3190—319F Kanbun 
    // 31A0—31BF Bopomofo Extended 
    // 31C0—31EF CJK Strokes 
    // 31F0—31FF Katakana Phonetic Extensions 
    // 3200—32FF Enclosed CJK Letters and Months 
    // 3300—33FF CJK Compatibility 
    // 3400—4DBF CJK Unified Ideographs Extension A 
    // 4DC0—4DFF Yijing Hexagram Symbols 
    // 4E00—9FFF CJK Unified Ideographs 
    // A000—A48F Yi Syllables 
    // A490—A4CF Yi Radicals 
    // A4D0—A4FF Lisu 
    // A500—A63F Vai 
    // A640—A69F Cyrillic Extended-B 
    // A6A0—A6FF Bamum 
    // A700—A71F Modifier Tone Letters 
    // A720—A7FF Latin Extended-D 
    // A800—A82F Syloti Nagri 
    // A830—A83F Common Indic Number Forms 
    // A840—A87F Phags-pa 
    // A880—A8DF Saurashtra 
    // A8E0—A8FF Devanagari Extended 
    // A900—A92F Kayah Li 
    // A930—A95F Rejang 
    // A960—A97F Hangul Jamo Extended-A 
    // A980—A9DF Javanese 
    // A9E0—A9FF Myanmar Extended-B 
    // AA00—AA5F Cham 
    // AA60—AA7F Myanmar Extended-A 
    // AA80—AADF Tai Viet 
    // AAE0—AAFF Meetei Mayek Extensions 
    // AB00—AB2F Ethiopic Extended-A 
    // AB30—AB6F Latin Extended-E 
    // AB70—ABBF Cherokee Supplement 
    // ABC0—ABFF Meetei Mayek 
    // AC00—D7AF Hangul Syllables 
    // D7B0—D7FF Hangul Jamo Extended-B 
    // D800—DB7F High Surrogates 
    // DB80—DBFF High Private Use Surrogates 
    // DC00—DFFF Low Surrogates 
    // E000—F8FF Private Use Area 
    // F900—FAFF CJK Compatibility Ideographs 
    // FB00—FB4F Alphabetic Presentation Forms 
	0xFB05 => 'st',
    // FB50—FDFF Arabic Presentation Forms-A 
    // FE00—FE0F Variation Selectors 
    // FE10—FE1F Vertical Forms 
    // FE20—FE2F Combining Half Marks 
    // FE30—FE4F CJK Compatibility Forms 
    // FE50—FE6F Small Form Variants 
	0xFE50 => ',', ',', '.', 0xFE54 => ';', ':', '?', '!', '-', '(', ')', '{', '}', 0xFE5F => '#',
	          '&', '*', '+', '-', '<', '>', '=', 0xFE68 => '\\', '$', '%', '@',
    // FE70—FEFF Arabic Presentation Forms-B 
    // FF00—FFEF Halfwidth and Fullwidth Forms 
    // FFF0—FFFF Specials 
    // 10000—1007F Linear B Syllabary 
    // 10080—100FF Linear B Ideograms 
    // 10100—1013F Aegean Numbers 
    // 10140—1018F Ancient Greek Numbers 
    // 10190—101CF Ancient Symbols 
    // 101D0—101FF Phaistos Disc 
    // 10280—1029F Lycian 
    // 102A0—102DF Carian 
    // 102E0—102FF Coptic Epact Numbers 
    // 10300—1032F Old Italic 
    // 10330—1034F Gothic 
    // 10350—1037F Old Permic 
    // 10380—1039F Ugaritic 
    // 103A0—103DF Old Persian 
    // 10400—1044F Deseret 
    // 10450—1047F Shavian 
    // 10480—104AF Osmanya 
    // 104B0—104FF Osage 
    // 10500—1052F Elbasan 
    // 10530—1056F Caucasian Albanian 
    // 10600—1077F Linear A 
    // 10800—1083F Cypriot Syllabary 
    // 10840—1085F Imperial Aramaic 
    // 10860—1087F Palmyrene 
    // 10880—108AF Nabataean 
    // 108E0—108FF Hatran 
    // 10900—1091F Phoenician 
    // 10920—1093F Lydian 
    // 10980—1099F Meroitic Hieroglyphs 
    // 109A0—109FF Meroitic Cursive 
    // 10A00—10A5F Kharoshthi 
    // 10A60—10A7F Old South Arabian 
    // 10A80—10A9F Old North Arabian 
    // 10AC0—10AFF Manichaean 
    // 10B00—10B3F Avestan 
    // 10B40—10B5F Inscriptional Parthian 
    // 10B60—10B7F Inscriptional Pahlavi 
    // 10B80—10BAF Psalter Pahlavi 
    // 10C00—10C4F Old Turkic 
    // 10C80—10CFF Old Hungarian 
    // 10E60—10E7F Rumi Numeral Symbols 
    // 11000—1107F Brahmi 
    // 11080—110CF Kaithi 
    // 110D0—110FF Sora Sompeng 
    // 11100—1114F Chakma 
    // 11150—1117F Mahajani 
    // 11180—111DF Sharada 
    // 111E0—111FF Sinhala Archaic Numbers 
    // 11200—1124F Khojki 
    // 11280—112AF Multani 
    // 112B0—112FF Khudawadi 
    // 11300—1137F Grantha 
    // 11400—1147F Newa 
    // 11480—114DF Tirhuta 
    // 11580—115FF Siddham 
    // 11600—1165F Modi 
    // 11660—1167F Mongolian Supplement 
    // 11680—116CF Takri 
    // 11700—1173F Ahom 
    // 118A0—118FF Warang Citi 
    // 11AC0—11AFF Pau Cin Hau 
    // 11C00—11C6F Bhaiksuki 
    // 11C70—11CBF Marchen 
    // 12000—123FF Cuneiform 
    // 12400—1247F Cuneiform Numbers and Punctuation 
    // 12480—1254F Early Dynastic Cuneiform 
    // 13000—1342F Egyptian Hieroglyphs 
    // 14400—1467F Anatolian Hieroglyphs 
    // 16800—16A3F Bamum Supplement 
    // 16A40—16A6F Mro 
    // 16AD0—16AFF Bassa Vah 
    // 16B00—16B8F Pahawh Hmong 
    // 16F00—16F9F Miao 
    // 16FE0—16FFF Ideographic Symbols and Punctuation 
    // 17000—187FF Tangut 
    // 18800—18AFF Tangut Components 
    // 1B000—1B0FF Kana Supplement 
    // 1BC00—1BC9F Duployan 
    // 1BCA0—1BCAF Shorthand Format Controls 
    // 1D000—1D0FF Byzantine Musical Symbols 
    // 1D100—1D1FF Musical Symbols 
    // 1D200—1D24F Ancient Greek Musical Notation 
    // 1D300—1D35F Tai Xuan Jing Symbols 
    // 1D360—1D37F Counting Rod Numerals 
    // 1D400—1D7FF Mathematical Alphanumeric Symbols 
    // 1D800—1DAAF Sutton SignWriting 
    // 1E000—1E02F Glagolitic Supplement 
    // 1E800—1E8DF Mende Kikakui 
    // 1E900—1E95F Adlam 
    // 1EE00—1EEFF Arabic Mathematical Alphabetic Symbols 
    // 1F000—1F02F Mahjong Tiles 
    // 1F030—1F09F Domino Tiles 
    // 1F0A0—1F0FF Playing Cards 
    // 1F100—1F1FF Enclosed Alphanumeric Supplement 
    // 1F200—1F2FF Enclosed Ideographic Supplement 
    // 1F300—1F5FF Miscellaneous Symbols and Pictographs 
    // 1F600—1F64F Emoticons (Emoji) 
    // 1F650—1F67F Ornamental Dingbats 
    // 1F680—1F6FF Transport and Map Symbols 
    // 1F700—1F77F Alchemical Symbols 
    // 1F780—1F7FF Geometric Shapes Extended 
    // 1F800—1F8FF Supplemental Arrows-C 
    // 1F900—1F9FF Supplemental Symbols and Pictographs 
);
?>