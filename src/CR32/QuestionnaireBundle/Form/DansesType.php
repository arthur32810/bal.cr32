<?php

namespace CR32\QuestionnaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DansesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('debutant', TextType::class, array('required'=> false))
        ->add('novice', TextType::class, array('required'=> false))
        ->add('intermediaire', TextType::class, array('required'=> false))
        ->add('avance', TextType::class, array('required'=> false))
        ->add('envoyer', SubmitType::class, array('label' => 'Voter'));
    }
}
