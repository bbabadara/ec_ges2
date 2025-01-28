<?php

namespace App\Form;

use App\Entity\Niveau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NiveauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('libelle', null, [
            'attr' => [
                'class' => 'bg-gray-50 border border-gray-300 mt-3 text-gray-900 text-sm rounded-lg w-full p-2.5',
            ],
        ])
        ->add('Ajouter', SubmitType::class, [
            'attr' => [
                'class' => 'bg-blue-700 text-white mt-3 px-10 py-2 rounded-md hover:bg-blue-800',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Niveau::class,
        ]);
    }
}
