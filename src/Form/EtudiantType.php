<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::Class,[
                'attr' => [
                'class' => 'bg-gray-50 border border-gray-500 mt-3 text-gray-900 text-sm rounded-lg w-full p-2.5',
            ],
            ])
            ->add('plainPassword',PasswordType::Class,[
                'attr' => [
                'class' => 'bg-gray-50 border border-gray-500 mt-3 text-gray-900 text-sm rounded-lg w-full p-2.5',
            ],
            ])
            ->add('nom',TextType::Class,[
                'attr' => [
                'class' => 'bg-gray-50 border border-gray-500 mt-3 text-gray-900 text-sm rounded-lg w-full p-2.5',
            ],
            ])
            ->add('prenom',TextType::Class,[
                'attr' => [
                'class' => 'bg-gray-50 border border-gray-500 mt-3 text-gray-900 text-sm rounded-lg w-full p-2.5',
            ],
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'libelle',
                'attr' => [
                    'class' => 'bg-gray-50 border border-gray-500 mt-3 text-gray-900 text-sm rounded-lg w-full p-2.5',
                ]
            ])
            ->add('Ajouter', SubmitType::class, [
                'attr' => [
                    'class' => 'bg-blue-700 text-white mt-3 px-10 py-2 rounded-md hover:bg-blue-800',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
