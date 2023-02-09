<?php
function stringHeadCanonical($globalServer = '', $globalRequest = '', $removeLastSlash = false){

  $globalServer = (!empty($globalServer)) ? $globalServer : $_SERVER;
  $globalRequest = (!empty($globalRequest)) ? $globalRequest : $_REQUEST;
  if(empty($_SERVER)) return false;

  if (empty($globalRequest['PAGEN_2']) && empty($globalRequest['PAGEN1_2'])){

      if(
        (!empty($globalServer['HTTPS']) && $globalServer['HTTPS'] != 'off') || 
        $_SERVER['SERVER_PORT'] == 443 
      ) 
        $protocol = 'https://';
      else $protocol = 'http://';
      
      $url = $protocol.$globalServer['SERVER_NAME'].$globalServer['REQUEST_URI'];
      
      $urlend = strrpos($url, '?', -1); // удаляем все параметры
      if($urlend != false) $url = substr($url, 0, $urlend);
      
      if($removeLastSlash && mb_substr($url, -1) == '/') $url = substr($url, 0, -1); // удаляем последний слеш
      
      $stringCanonical = '<link rel="canonical" href="'.$url.'" />';

      return $stringCanonical;
  }
}
?>