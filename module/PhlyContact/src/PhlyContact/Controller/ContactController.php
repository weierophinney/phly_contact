<?php
namespace PhlyContact\Controller;

use Zend\Mail\Transport,
    Zend\Mail\Message as Message,
    Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel;

class ContactController extends ActionController
{
    protected $form;
    protected $message;
    protected $transport;

    public function setMessage(Message $message)
    {
        $this->message = $message;
    }

    public function setMailTransport(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function setContactForm(ContactForm $form)
    {
        $this->form = $form;
    }

    public function indexAction()
    {
        return array('form' => $this->form);
    }

    public function processAction()
    {
        if (!$this->request->isPost()) {
            $this->response->setStatusCode(302);
            $this->response->headers()
                 ->addHeaderLine('Location', '/contact');
        }
        $post = $this->request->post()->toArray();
        $form = $this->form;
        if (!$form->isValid($post)) {
            $model = new ViewModel(array(
                'error' => true,
                'form'  => $form
            ));
            $model->setTemplate('contact/index');
            return $model;
        }

        // send email...
        $this->sendEmail($form->getValues());

        return $this->redirect()->toRoute('contact/thank-you');
    }

    protected function sendEmail(array $data)
    {
        $from    = $data['from'];
        $subject = '[Contact Form] ' . $data['subject'];
        $body    = $data['body'];

        $this->message->addFrom($from)
                      ->addReplyTo($from)
                      ->setSubject($subject)
                      ->setBody($body);
        $this->transport->send($this->message);
    }

    public function thankYouAction()
    {
        $headers = $this->request->headers();
        if (!$headers->has('Referer')
            || !preg_match('#/contact/process$#',
                  $headers->get('Referer')->getFieldValue())
        ) {
            $this->response->setStatusCode(302);
            $this->response->headers()
                 ->addHeaderLine('Location', '/contact');
        }

        return array();
    }
}
