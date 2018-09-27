<?php 
namespace aalfiann\middleware;
    /**
     * A PSR7 middleware for url parameter firewall
     *
     * @package    aalfiann/url-param-firewall
     * @author     M ABD AZIZ ALFIAN <github.com/aalfiann>
     * @copyright  Copyright (c) 2018 M ABD AZIZ ALFIAN
     * @license    https://github.com/aalfiann/url-param-firewall/blob/master/LICENSE  MIT License
     */
    class ParamFirewall
    {
        private $whitelist;

        public function __construct(array $whitelist){
            $this->whitelist = $whitelist;
        }

        /**
         * Param Firewall invokable class
         * 
         * @param \Psr\Http\Message\ServerRequestInterface  $request    PSR7 request
         * @param \Psr\Http\Message\ResponseInterface       $response   PSR7 response
         * @param callable                                  $next       Next middleware
         * 
         * @return \Psr\Http\Message\ResponseInterface
         */
        public function __invoke($request,$response,$next){
            if (!empty($this->whitelist)){
                foreach ($_GET as $key => $value) {
                    if (!in_array($key,$this->whitelist)){
                        throw new \Slim\Exception\NotFoundException($request, $response);
                    }
                }
            }
            $response = $next($request, $response);
            return $response;
        }
    }