<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Repository\CatalogueRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Catalogue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AddProduitType extends AbstractType
{
    private $cat;

    public function __construct(CatalogueRepository $catalogue)
    {
        $this->cat = $catalogue->findAll();
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Description',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Quantite',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Prix',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Image', FileType::class, array('attr' => array('class' => 'form-control')))
            ->add('Catalogue',  EntityType::class, [
                'class' => Catalogue::class,
                'choice_label' => function ($catalogue) {
                    return $catalogue->getName();
                }
            ])
            ->add('valider', SubmitType::class, array('attr' => array('class' => 'btn btn-danger btn-lg')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
