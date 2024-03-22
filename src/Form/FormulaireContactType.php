<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FormulaireContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
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
        ]);
    }
}
