<?php

namespace App\Http;

class Router{
    private $url = '';
    private $prefix = '';
    private $routes = [];
    private $request;
    
    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    public function setPrefix(){
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    public function addRoute($method, $route, $params = []){
        foreach($params as $key => $value){
            if($value instanceof \Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }
        $params['variables'] = [];
        $patternRoute = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $route);
        $patternRoute = '/^' . str_replace('/', '\/', $patternRoute) . '$/i';
        $this->routes[$patternRoute][$method] = $params;
    }

    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);
    }

    public function post($route, $params = []){
        return $this->addRoute('POST', $route, $params);
    }

    public function put($route, $params = []){
        return $this->addRoute('PUT', $route, $params);
    }

    public function delete($route, $params = []){
        return $this->addRoute('DELETE', $route, $params);
    }

    private function getUri(){
        $uri = $this->request->getUri();
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        return end($xUri);
    }

    private function getRoute(){
        $url = $this->getUri();
        $httpMethod = $this->request->getHttpMethod();
        foreach($this->routes as $patternRoute => $methods){
            if(preg_match($patternRoute, $url, $matches)){
                if (isset($methods[$httpMethod])) {
                    unset($matches[0]);
                    $keys = array_keys($methods[$httpMethod]['variables']);
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;
                    return $methods[$httpMethod];
                }

                throw new Exception("Método não permitido", 405);
            }
        }
        throw new \Exception("URL não encontrada", 404);
        return false;
    }

    public function run(){
        try {
            $route = $this->getRoute();

            if(!isset($route['controller'])){
                throw new \Exception("URL não pôde ser processada", 500);
            }

            $args = [];

            $reflection = new \ReflectionFunction($route['controller']);
            foreach($reflection->getParameters() as $parameter){
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            return call_user_func_array($route['controller'], $args);
        } catch (\Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}