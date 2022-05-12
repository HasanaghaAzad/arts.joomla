<?php
/**
 * @version     $Id: az-AZ.localise.php 15628 2010-03-27 05:20:29Z Guluzade joomla-az.org $
 * @copyright   Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

 defined('_JEXEC') or die;
 
/**
 * az-AZ localise class
 *
 * @package		Joomla.Site
 * @since		1.6
 */
abstract class az_AZLocalise
{
	/**
	 * Returns the potential suffixes for a specific number of items
	 *
	 * @param	int $count  The number of items.
	 * @return	array  An array of potential suffixes.
	 * @since	1.6
	 */
	public static function getPluralSuffixes($count)
	{
		if ($count == 0) {
			$return = array('0');
		}
		elseif ($count == 1) {
			$return = array('1');
		}
		else {
			$return = array('MORE');
		}
		return $return;
	}
    /**
     * Returns the ignored search words
     *
     * @return      array  An array of ignored search words.
     * @since       1.6
     */
        public static function getIgnoredSearchWords() {
                $search_ignore = array();
                $search_ignore[] = "və";
                $search_ignore[] = "da";
                $search_ignore[] = "də";
				$search_ignore[] = "ki";
                $search_ignore[] = "ilə";
                $search_ignore[] = "sair";
				$search_ignore[] = "kimi";
                $search_ignore[] = "hər";
                $search_ignore[] = "bütün";
				$search_ignore[] = "ancaq";
                $search_ignore[] = "amma";
                $search_ignore[] = "lakin";
                return $search_ignore;
        }
		
        /**
         * Returns the lower length limit of search words
         *
         * @return      integer  The lower length limit of search words.
         * @since       1.6
         */
        public static function getLowerLimitSearchWord() {
                return 3;
        }
        /**
         * Returns the upper length limit of search words
         *
         * @return      integer  The upper length limit of search words.
         * @since       1.6
         */
        public static function getUpperLimitSearchWord() {
                return 20;
        }
        /**
         * Returns the number of chars to display when searching
         *
         * @return      integer  The number of chars to display when searching.
         * @since       1.6
         */
        public static function getSearchDisplayedCharactersNumber() {
                return 200;
        }

	public static function transliterate($string)
	{
		$str = JString::strtolower($string);

		$glyph_array = array(
			'a' => 'a',
			'b' => 'b',
			'dz' => 'c',
			'ch' => 'ç',
			'd' => 'd',
			'e' => 'е',
			'ae' => 'ə',
			'f' => 'f',
			'j' => 'g',
			'gh' => 'ğ',
			'h' => 'h',
			'kh' => 'x',			
			'y' => 'ı',
			'i' => 'i',
			'zh' => 'j',
			'k' => 'k',
			'g' => 'q',
			'l' => 'l',
			'm' => 'm',
			'n' => 'n',
			'o' => 'o',
			'oe' => 'ö',
			'p' => 'p',
			'r' => 'r',
			's' => 's',
			'sh' => 'ş',
			't' => 't',
			'u' => 'u',
			'u' => 'ü',
			'v' => 'v',
			'y' => 'y',
			'z' => 'z',

		);

		foreach ($glyph_array as $letter => $glyphs) {
			$glyphs = explode(',', $glyphs);
			$str = str_replace($glyphs, $letter, $str);
		}

		return $str;
	}




}

