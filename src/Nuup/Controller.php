<?php

namespace Nuup;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class Controller implements ControllerProviderInterface {
    /** @var Application */
    protected $app;

    /** @var $twig \Twig_Environment */
    private $twig;

    /** @var $security Security Provider*/
    private $security;

    /** @var $session Session Provider*/
    private $session;

    /** @var $db Doctrine provider*/

    public function __construct(Application $app) {
        $this->app = $app;
    }

    /**
     * @return \Twig_Environment
     */
    protected function twig() {
        if (is_null($this->twig)) {
            $this->twig = $this->app['twig'];
        }

        return $this->twig;
    }

    /**
     * @return Doctrine provider
     */

    protected function db(){
    	if (is_null($this->db)) {
            $this->db = $this->app['db'];
        }

        return $this->db;
    }

    /**
     * @return Security provider
     */

    protected function security(){
    	if (is_null($this->security)) {
            $this->security = $this->app['security'];
        }
        return $this->security;
    }

    protected function session(){
    	if (is_null($this->session)) {
            $this->session = $this->app['session'];
        }
        return $this->session;	
    }
}
