<?php
return array('di' => array(
    'preferences' => array(
        'Zend\Captcha\Adapter' => 'Zend\Captcha\Dumb',
        'Zend\Mail\Transport'  => 'Zend\Mail\Transport\File',
    ),
    'instance' => array(
        'contact' => array('parameters' => array(
            'transport' => 'Zend\Mail\Transport\File',
            'message'   => 'Zend\Mail\Message',
        )),
        'PhlyContact\ContactForm' => array('parameters' => array(
            'captchaAdapter' => 'Zend\Captcha\Dumb',
        )),
        'Zend\Mail\Transport\FileOptions' => array('parameters' => array(
            'path' => 'data/',
        )),
        'Zend\Mail\Message' => array('parameters' => array(
            'Zend\Mail\Message::addTo:emailOrAddressList' => 'me@mwop.net',
            'Zend\Mail\Message::setSender:emailOrAddressList' => 'me@mwop.net',
        )),
    )),
);
