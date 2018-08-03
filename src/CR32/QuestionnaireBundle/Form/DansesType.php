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
        ->add('debutant1', TextType::class, array('required'=> false))
        ->add('debutant2', TextType::class, array('required'=> false))
        ->add('novice1', TextType::class, array('required'=> false))
        ->add('novice2', TextType::class, array('required'=> false))
        ->add('intermediaire1', TextType::class, array('required'=> false))
        ->add('intermediaire2', TextType::class, array('required'=> false))
        ->add('avance1', TextType::class, array('required'=> false))
        ->add('avance2', TextType::class, array('required'=> false))
        ->add('envoyer', SubmitType::class);
    }
}
