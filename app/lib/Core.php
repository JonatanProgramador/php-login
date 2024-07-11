<?php
class Core
{

  protected $controller;
  protected $method;
  protected $parameters = [];
  protected $url;

  public function __construct()
  {
    $this->getURL();
    if ($this->existsController() && $this->existsFunction()) {
      $this->existsParameters();
      call_user_func_array([$this->controller, $this->method], $this->parameters);
    } else {
     Response::$code=404;
     Response::$message = "No found";
     Response::send();
    }
  }

  private function existsController(): bool
  {
    if (count($this->url) < 3 && file_exists('../app/controllers/' . ucwords($this->url[0]) . '.php')) {
      $this->controller = ucwords($this->url[0]);
      unset($this->url[0]);
      require_once '../app/controllers/' . $this->controller . '.php';
      return true;
    } else {
      return false;
    }
  }

  private function existsFunction(): bool
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        $this->method = isset($this->url[1]) ? "show" : "index";
        break;
      case 'POST':
        $this->method = isset($this->url[1]) ? null : "store";
        break;
      case 'PUT':
        $this->method = isset($this->url[1]) ? "update" : null;
        break;
      case 'DELETE':
        $this->method = isset($this->url[1]) ? "delete" : null;
        break;
      default:
        return false;
    }
    if (method_exists($this->controller, $this->method)) {
      return true;
    } else {
      return false;
    }
  }

  private function existsParameters(): bool
  {
    if (isset($this->url)) {
      $this->parameters = $this->url;
      return true;
    } else {
      return false;
    }
  }

  private function getURL(): void
  {
    if (isset($_SERVER['REDIRECT_URL'])) {
      $urls = explode('/', $_SERVER['REDIRECT_URL']);
      $urls = array_splice($urls, 1);
      $this->url = $urls;
    }
  }
}
