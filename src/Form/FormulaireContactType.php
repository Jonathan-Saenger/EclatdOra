<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormulaireContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
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
            ->add('email')
            ->add('telephone')
            ->add('message', TextareaType::class, [
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
           /* ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'csrf_protection' => true,
        ]);
    }
}
