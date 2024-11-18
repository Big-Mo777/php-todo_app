<?php 
namespace App;
 
class Router {
    private $routes = [];

    public function get(string $url, callable $action) {
  $this->addRoute(method: 'Get' , url: $url, action: $action); 
    }

    public function post(string $url, callable $action) {
        $this->addRoute(method: 'POST', url: $url, action: $action);
    }
    private function addRoute($method, $url, $action) {
        
            $this ->routes[] = [
                "method"=> "$method",
                "url"=>"$url",
                "action"=> $action
            ]; 
        }
    
        public function resolve() {}
    }



