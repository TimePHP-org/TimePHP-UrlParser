<?php

namespace TimePHP\UrlParser;

class Parser {
   

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

   public function __construct(){
      $this->url = $_SERVER["PATH_INFO"];
      $this->method = $_SERVER["REQUEST_METHOD"];
      $this->domain = $_SERVER["SERVER_NAME"];
   }

   /**
    * return the current url
    *
    * @return string
    */
   public function getUrl(): string {
      return $this->url;
   }


   /**
    * Return the current request method (GET, POST, HEAD, PUT)
    *
    * @return string
    */
   public function getMethod(): string {
      return $this->method;
   }

   public function getDomain(): string {
      return $this->domain;
   }





}