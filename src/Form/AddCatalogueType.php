<?php

namespace App\Form;

use App\Entity\Catalogue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class AddCatalogueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Description',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Icon', FileType::class, array('attr' => array('class' => 'form-control')))
            ->add('nb_produit',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('valider', SubmitType::class, array('attr' => array('class' => 'btn btn-danger btn-lg')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Catalogue::class,
        ]);
    }
}
