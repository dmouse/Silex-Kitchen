<?php

use Walker\Controller;

use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;

use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;





/*---

    $app->get('/account', function () use ($app) {

        $token = $app['security']->getToken();

        if (null !== $token) {
            $user = $token->getUsername();
        }
        return $user;
    });
    $app->match('/login', function(Request $request) use ($app) {
        $form = $app['form.factory']->createBuilder('form')
            ->add('username', 'text', array('label' => 'Username', 'data' => $app['session']->get('_security.last_username')))
            ->add('password', 'password', array('label' => 'Password'))
            ->getForm()
        ;

        return $app['twig']->render('login.html.twig', array(
            'form'  => $form->createView(),
            'error' => $app['security.last_error']($request),
        ));
    })->bind('login');

    $app->get('/', function () use ($app) {

        $article = new Walker\Entity\Article();
        $article->setContent('Hello world!');
        $article->setTitle('=)');
        $app['db.orm.em']->persist($article);
        $app['db.orm.em']->flush();


        return $app['twig']->render('index.html.twig', array());
    })
    ->bind('homepage')
    ;

    $app->get('/menu', function () use ($app) {
        return $app['twig']->render('menu.html.twig');
    })
    ->bind('menu')
    ;



    $app->match('/logout', function() use ($app) {
        $app['session']->clear();
        return $app->redirect($app['url_generator']->generate('homepage'));
    })->bind('logout');
*/


