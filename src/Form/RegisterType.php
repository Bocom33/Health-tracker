<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('forname', TextType::class, [
                'attr' =>array(
                    'placeholder' => 'Prénom',
                ),
                'label' => false,
            ])
            ->add('name', TextType::class, [
                'attr' =>array(
                    'placeholder' => 'Nom',
                ),
                'label' => false,
            ])
            ->add('email', EmailType::class, [
                'attr' => array(
                    'placeholder' => 'Adresse email',
                ),
                'label' => false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'attr' => ['class' => 'agree'],
                'label' => 'En cochant cette case, je reconnais avoir pris connaissance et 
                accepte la politique de confidentialité relative aux données des utilisateurs.',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                    'attr' => array(
                        'placeholder' => 'Entrez votre mot de passe',
                    ),
                    'label' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe',
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                            'max' => 30,
                            'maxMessage' => 'Votre mot de passe doit faire {{ limit }} au maximum'
                        ]),
                    ]]
            );
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
