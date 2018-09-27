# URL Parameter Firewall

[![Version](https://img.shields.io/badge/latest-1.0.0-green.svg)](https://github.com/aalfiann/url-param-firewall)
[![Total Downloads](https://poser.pugx.org/aalfiann/url-param-firewall/downloads)](https://packagist.org/packages/aalfiann/url-param-firewall)
[![License](https://poser.pugx.org/aalfiann/url-param-firewall/license)](https://github.com/aalfiann/url-param-firewall/blob/HEAD/LICENSE.md)

A PSR7 middleware for url parameter firewall for [Slim Framework 3](https://slimframework.com).  

### Why we should create firewall for url parameter?
1. To prevent from ddos layer 7 which is targeting to attack using random url parameters.
2. To prevent useless webpage cache.
3. To avoid BOT goes to wrong url.
4. To hardening the CSRF and XSS attack.
5. Etc.

So you better to whitelisting url parameter for each routes. 


## Installation

Install this package via [Composer](https://getcomposer.org/).
```
composer require "aalfiann/url-param-firewall:^1.0"
```

## Usage

```php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \aalfiann\middleware\ParamFirewall;

$app->get('/', function (Request $request, Response $response) {
    $body = $response->getBody();
    $body->write('You will see this message if passed url firewall');
    
    return $response->withBody($body);
})->(new ParamFirewall(['_','page']))->setName("/");
```

Open browser and now make a test:  
http://yourdomain.com/                                  >> WORK  
http://yourdomain.com/?page=1                           >> WORK  
http://yourdomain.com/?page=1&_=3123123                 >> WORK  
http://yourdomain.com/?product=test                     >> 404  
http://yourdomain.com/?page=1&_=3123123&product=test    >> 404  


Note:  
We should allow url param name `_` because it used in jquery ajax cache. 