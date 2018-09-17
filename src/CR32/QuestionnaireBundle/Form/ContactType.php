<?php

namespace CR32\QuestionnaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',       TextType::class, array(
                                        'label' => 'Nom',
                                        'attr' => array('placeholder' => 'Votre Nom')))
        ->add('surname',    TextType::class, array(
                                        'label' => 'Prénom',
                                        'attr' => array('placeholder' => 'Votre Prénom')))
        ->add('secret',     TextType::class, array(
                                        'label'=> 'Mot secret',
                                        'attr' => array('placeholder'=>'Votre mot secret')))
        ->add('club',       TextType::class, array(
                                        'label' => 'Votre Club',
                                        'attr' => array('placeholder'=>'Votre club'),
                                        'required'=>false))
        ->add('envoyer',     SubmitType::class, array('attr' => array('class'=>'float-right')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CR32\QuestionnaireBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cr32_contact';
    }


}
