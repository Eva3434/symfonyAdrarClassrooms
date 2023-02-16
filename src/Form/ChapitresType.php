<?php

namespace App\Form;
use App\Entity\Cours;
use App\Entity\Chapitres;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapitresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { $cours = new Cours();
        $builder
            ->add('chapitre_titre')
            ->add('chapitre_contenu')
            ->add('chapitre_position')
            ->add('cours', EntityType::class, array('class' => 'App\Entity\Cours',
                            'choice_label' => 'titre_cour', 'placeholder' => 'Choisissez le cours'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chapitres::class,
        ]);
    }
}
