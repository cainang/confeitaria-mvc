<?php

namespace App\Http;

class Request{
    private $httpMethod;
    private $uri;
    private $queryParams = [];
    private $postVars = [];
    private $headers = [];
    private $router;

    public function __construct($router){
        $this->router = $router;
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->setUri();
    }

    private function setUri() {
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        $xUri = explode('?', $this->uri);
        $this->uri = $xUri[0];
    }

    public function getRouter(){
        return $this->router;
    }

    public function getHttpMethod(){
        return $this->httpMethod;
    }

    public function getUri(){
        return $this->uri;
    }

    public function getQueryParams(){
        return $this->queryParams;
    }

    public function getPostVars(){
        return $this->postVars;
    }

    public function getHeaders(){
        return $this->headers;
    }
}
