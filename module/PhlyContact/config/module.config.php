<?php
return array(
    'di' => array(
        'preferences' => array(
            'Zend\Captcha\Adapter' => 'Zend\Captcha\Dumb',
        ),
        'definition' => array('class' => array(
            'PhlyContact\ContactForm' => array(
                '__construct' => array(
                    'required' => true,
                    'captchaAdapter' => array(
                        'required' => true,
                        'type'     => 'Zend\Captcha\Adapter',
                    ),
                ),
            ),
            'Zend\Mail\Message' => array(
                'addTo' => array(
                    'emailOrAddressList' => array(
                        'type' => false,
                        'required' => true,
                    ),
                    'name' => array(
                        'type' => false,
                        'required' => false,
                    ),
                ),
                'addFrom' => array(
                    'emailOrAddressList' => array(
                        'type' => false,
                        'required' => true,
                    ),
                    'name' => array(
                        'type' => false,
                        'required' => false,
                    ),
                ),
                'setSender' => array(
                    'emailOrAddressList' => array(
                        'type' => false,
                        'required' => true,
                    ),
                    'name' => array(
                        'type' => false,
                        'required' => false,
                    ),
                ),
            ),
        )),
        'instance' => array(
            'PhlyContact\Controller\ContactController' => array('parameters' => array(
                'form'      => 'PhlyContact\ContactForm',
            )),
            'Zend\View\Resolver\TemplateMapResolver' => array('parameters' => array(
                'map'  => array(
                    'contact/index'     => __DIR__ . '/../view/contact/index.phtml',
                    'contact/thank-you' => __DIR__ . '/../view/contact/thank-you.phtml',
                ),
            )),
            'Zend\View\Resolver\TemplatePathStack' => array('parameters' => array(
                'paths'  => array(
                    'contact' => __DIR__ . '/../view',
                ),
            )),
            'Zend\Mvc\Router\RouteStack' => array('parameters' => array(
                'routes' => array(
                    'contact' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/contact',
                            'defaults' => array(
                                'controller' => 'PhlyContact\Controller\ContactController',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'process' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/process',
                                    'defaults' => array(
                                        'action'     => 'process',
                                    ),
                                ),
                            ),
                            'thank-you' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/thank-you',
                                    'defaults' => array(
                                        'action'     => 'thank-you',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            )),
        ),
    ),
);
