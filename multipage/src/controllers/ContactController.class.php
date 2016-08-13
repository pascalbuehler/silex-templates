<?php
require_once __DIR__.'/../classes/AbstractController.class.php';

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactController extends AbstractController {
    public function contact() {
        $this->addData('title', 'Contact');

        $form = $this->app['form.factory']->createBuilder(FormType::class)
            ->add('name', TextType::class, array(
                'attr' => array('placeholder' => 'Name'),
                'label' => 'Name',
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 3)))))
            ->add('email', EmailType::class, array(
                'attr' => array('placeholder' => 'E-Mail'),
                'label' => 'E-Mail',
                'constraints' => new Assert\Email()))
            ->add('submit', SubmitType::class, array(
                'label' => 'Send'))
            ->getForm();

        $request = $this->app['request_stack']->getCurrentRequest();
        $form->handleRequest($request);
        
        $this->addData('form', $form->createView());
        
        return '';
    }
}

