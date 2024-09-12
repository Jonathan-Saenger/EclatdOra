<?php

namespace App\Form;

use App\Entity\Temoignage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;

class TemoignageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'constraints' => [
                    new Length ([
                        'min' => 2, 
                        'minMessage' => 'Veuillez saisir un minimum de {{ limit }} caractères',
                        'max' => 15, 
                        'maxMessage' => 'Vous avez dépassé le nombre de caractères limités',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z-]+$/',
                        'match' => true, 
                        'message' => 'Vous avez employé un caractère non autorisé, merci de le supprimer '
                    ]),
                ]
            ])
            ->add('Metier', TextType::class, [
                'constraints' => [
                    new Length ([
                        'min' => 2, 
                        'minMessage' => 'Veuillez saisir un minimum de {{ limit }} caractères',
                        'max' => 15, 
                        'maxMessage' => 'Vous avez dépassé le nombre de caractères limités',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z-]+$/',
                        'match' => true, 
                        'message' => 'Vous avez employé un caractère non autorisé, merci de le supprimer '
                    ]),
                ]
            ])
            ->add('Email')
            ->add('Commentaire', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre message.']),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre message ne peut pas comporter moins de {{ limit }} caractères.',
                        'max' => 1500,
                        'maxMessage' => 'Votre message ne peut pas comporter plus de {{ limit }} caractères.',
                    ]),
                ],
            ])
            /*->add('imageName')
            ->add('imageSize')
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('Relation', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Temoignage::class,
            'csrf_pritection' =>true,
        ]);
    }
}
