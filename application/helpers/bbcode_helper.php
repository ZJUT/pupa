<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if( ! function_exists('bb2Markdown') ){
  function bb2Markdown($bbcode) {
    $matches = array();
    $search = array (
      "/\n/", //newlines
      "/\[b\](.*)\[\/b]/Ui", //bold
      "/\[i\](.*)\[\/i]/Ui", //italic
      "/\[u\](.*)\[\/u]/Ui", //underline
      "/\[img\](.*)\[\/img]/Ui", //images
      "/\[code\](.*)\[\/code\]/Uis", //code-blocks
      "/\[url\](.*)\[\/url\]/Ui", //links
      "/\[url=(.*)\](.*)\[\/url\]/Ui", //links with names
      "/\[color.*\](.*)\[\/color.*\]/Ui", //color
      "/\[size.*\](.*)\[\/size.*\]/Ui", //color
      "/\[quote\](.*)\[\/quote]/Ui",
      "/\[attach\](.*)\[\/attach]/Ui",
    );

    $replace = array (
      "   \n",
      '__\1__', // bold
      '_\1_', // italic
      '_\1_', // underline
      '![\1](\1)', //images to links
      '<pre>\1</pre>', // code-blocks
      '[\1](\1)',
      '[\1](\2)',
      '\1',
      '\1',
      '> \1',
      '[\1]',
    );
    $count = 0;
    $bbcode = preg_replace($search, $replace, $bbcode, -1, $count);
    return $bbcode;
    //if($count == 0) return $bbcode;
    //else return bb2Markdown($bbcode);
  }

}
