<?php

namespace Walker\Controller;

use Walker\Controller;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Walker\Silex\Provider\MongoDBServiceProvider;


class Backend extends Controller{
	public function connect(Application $app) {
        
        $controllers = $app['controllers_factory'];


        $controllers->get('/', array(
        	$this, 'indexAction'
		))->bind('homepage');

		$controllers->get('/login', array(
        	$this, 'loginAction'
		))->bind('login');

		$controllers->get('/logout',array(
			$this, 'logoutAction'
		))->bind('logout');

		
        return $controllers;
    }

    public function indexAction(Request $request, Application $app) {

    	$article = new \Walker\Entity\Article();
        $article->setTitle('=)');
        $app['doctrine.odm.mongodb.dm']->persist($article);
        $app['doctrine.odm.mongodb.dm']->flush();


        return $this->twig()->render('index.html.twig');
        //return new Response('', 404);
    }

    public function loginAction(Request $request, Application $app){

    	$form = $app['form.factory']->createBuilder('form')
        	->add('username', 'text', array('label' => 'Username', 'data' => $app['session']->get('_security.last_username')))
        	->add('password', 'password', array('label' => 'Password'))
        	->add('password', 'password', array('label' => 'Password'))
        ->getForm();

    	return $this->twig()->render('login.html.twig', array(
        	'form'  => $form->createView(),
        	'error' => $app['security.last_error']($request),
    	));
    }

    public function logoutAction(Request $request, Application $app){
    	$this->session()->clear();
    	return $app->redirect($app['url_generator']->generate('homepage'));
    }

}