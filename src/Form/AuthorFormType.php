<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 01/07/2018
 * Time: 09.30
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AuthorFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                [
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ])
            ->add('title', TextType::class,
                [
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ])
            ->add('company', TextType::class,
                [
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ])
            ->add('shortBio', TextareaType::class,
                [
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ])
            ->add('phone', TextType::class,
                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false
                ])
            ->add('facebook', TextType::class,
                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false
                ])
            ->add('twitter', TextType::class,
                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false
                ])
            ->add('github', TextType::class,
                [
                    'attr' => ['class' => 'form-control'],
                    'required' => false
                ])
            ->add('submit', SubmitType::class,
                [
                    'attr' => ['class' => 'form-control btn btn-primary pull-right'],
                    'label' => 'Become an Author!'
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Author'
        ]);
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'author_form';
    }
}