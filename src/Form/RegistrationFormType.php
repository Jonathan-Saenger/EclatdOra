<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nom', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Veuillez saisir un minimum de {{limit}} caractères',
                        'max' => 15,
                        'maxMessage' => 'Vous avez dépassé le nombre de caractère limités',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z-]+$/',
                        'match' => true,
                        'message' => 'Vous avez employé un caractère non autorisé, merci de le supprimer'
                    ]),
                ]
            ])
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new Length ([
                        'min' => 5,
                        'minMessage' => 'Veuillez saisir un minimum de caractère',
                        'max' => 15,
                        'maxMessage' => 'Vous avez dépasser le nombre de caractères limités',
                    ]),
                    new Regex([
                        'pattern' => '/^[a-zA-Z-]+$/',
                        'match' => true,
                        'message' => 'Vous avez employé un caractère non autorisé, merci de le supprimer'
                    ])
                ]
            ])
            ->add('adresse', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9 ]+$/',
                        'match' => true,
                        'message' => 'Vous avez employé un caractère non autorisé, merci de le supprimer'
                    ]),
                ]
            ])
            ->add('telephone')
            ->add('codePostal', IntegerType::class, [
                'constraints' => [
                    new Length ([
                        'min' => 5,
                        'minMessage' => 'Merci de saisir un code postal valide',
                        'max' => 7, 
                        'maxMessage' => 'Merci de saisir un code postal valide',
                    ]),
                ]
            ])
            ->add('ville', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z-]+$/',
                        'match' => true,
                        'message' => 'Vous avez employé un caractère non autorisé, merci de le supprimer'
                    ]),
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Merci de cocher la condition d\'acceptation',
                    ]),
                ],
                'label' => 'En soumettant ce formulaire, j’accepte que mes informations soient utilisées dans le cadre de mon inscription.',
            
            ])
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\/:,])[A-Za-z\d@$!%*?&\/:,]{8,}$/',
                        'message' => 'Votre Password doit contenir au moins une lettre majuscule, un chiffre, un caractère spécial et 8 caractères.',
                    ]),
                ],
                'label' => 'Mot de passe',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
