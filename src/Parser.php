<?php

namespace TimePHP\UrlParser;

use TimePHP\UrlParser\Exception\ParserException;

class Parser
{


   /**
    * Url pass un parameter  
    *
    * @var string
    */
   private $url;

   /**
    * Method of the current request (GET, POST, PUT, HEAD)
    *
    * @var string
    */
   private $method;

   /**
    * Domain name
    *
    * @var string
    */
   private $domain;

   public function __construct()
   {
      $this->url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
      $this->method = $_SERVER["REQUEST_METHOD"];
      $this->domain = $_SERVER["SERVER_NAME"];
   }

   /**
    * return the current url
    *
    * @return string
    */
   public function getUrl(): string
   {
      return $this->url;
   }

   /**
    * Return the current request method (GET, POST, HEAD, PUT)
    *
    * @return string
    */
   public function getMethod(): string
   {
      return $this->method;
   }

   /**
    * Return the domain
    *
    * @return string
    */
   public function getDomain(): string
   {
      return $this->domain;
   }

   /**
    * Undocumented function
    *
    * @return mixed|null
    */
   public function getInfo(string $index = null)
   {
      $info = parse_url($this->getUrl());
      if ($index === null) {
         return $info;
      } else {
         if (array_key_exists($index, $info)) {
            return $info[$index];
         } else {
            throw new ParserException("Can not find the index $index", 6001);
         }
      }
   }

   /**
    * Return a value from $_GET for a specific index
    *
    * @param string $index
    * @return mixed|null
    */
   public function get(string $index = null)
   {
      if ($index === null) {
         $list = [];
         foreach($_GET as $key => $value){
            if(filter_var($value, FILTER_VALIDATE_INT)) $list[$key] = (int)$value;
            elseif(filter_var($value, FILTER_VALIDATE_FLOAT)) $list[$key] = (float)$value;
            elseif(filter_var($value, FILTER_VALIDATE_BOOLEAN)) $list[$key] = (bool)$value;
            else $list[$key] = $value;
         }
         return $list;
      } else {
         if(array_key_exists($index, $_GET)) {
            if(filter_var($_GET[$index], FILTER_VALIDATE_INT)) return (int)$_GET[$index];
            elseif(filter_var($_GET[$index], FILTER_VALIDATE_FLOAT)) return (float)$_GET[$index];
            elseif(filter_var($_GET[$index], FILTER_VALIDATE_BOOLEAN)) return (bool)$_GET[$index];
            else return $_GET[$index];
         } else {
            throw new ParserException("Can not find the index $index", 6001);
         }
      }
   }
}
