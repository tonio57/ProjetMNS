<?php

namespace App\Form;

use App\Entity\Films;
use App\Entity\Salle;
use App\Entity\Seance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateTimeType::class, [
                "widget" => "single_text"
            ])
            ->add('langue', TextType::class)
            ->add('salle', EntityType::class, [
                "class" => Salle::class,
                "choice_label" => "Numero"
            ])
            ->add('films', EntityType::class, [
                "class" => Films::class,
                "choice_label" => "title"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seance::class,
        ]);
    }
}
