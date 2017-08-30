<?php

namespace Acme\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Acme\NewsBundle\Entity\db_news;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class db_newsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datePublic',  DateType::class)
            ->add('publication', ChoiceType::class, array(
                'choices' => array(
                    'publication' => array(
                        '1' => 'Yes',
                        '0' => 'No',
                    ),
                ),
            ))
            ->add('shortText', TextareaType::class)
            ->add('allText', TextareaType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => db_news::class,
        ));
    }
}