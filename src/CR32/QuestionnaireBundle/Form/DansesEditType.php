<?php

namespace CR32\QuestionnaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DansesEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre', TextType::class)
        ->add('niveau', ChoiceType::class, array(
            'choices' => array(
                'Débutant' => 1,
                'Novice' => 2,
                'Intermediaire' => 3,
                "Avancé" => 4)))
        ->add('modifier', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CR32\QuestionnaireBundle\Entity\Danses'
        ));
    }
}
