<?php

namespace core;

class Route {

    public $namespace = null;
    public $controller = null;
    public $method = null;
    public $roles = null;
    public $redirectPath;

    /**
     * @param type $namespace
     * @param type $controller
     * @param type $method
     * @param type $roles
     * @param type $redirectPath
     */
    public function __construct($namespace, $controller, $method, $roles, $redirectPath = null) {
        $this->namespace = $namespace;
        $this->controller = $controller;
        $this->method = $method;
        $this->roles = $roles;
        $this->redirectPath = $redirectPath;
    }

}
