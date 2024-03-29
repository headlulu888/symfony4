<?php

namespace App\Form;


use App\Entity\Page;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
//            ->add('title', 'Symfony\Component\Form\Extension\Core\Type\TextareaType')
            ->add('title', TextareaType::class, [
                'label_attr' => ['class' => 'label'],
                'label' => 'Заголовок',
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Контент',
                'label_attr' => ['class' => 'label'],
                'attr' => [
                    'class' => 'textarea'
                ]
            ])
            ->add('publish', CheckboxType::class, [
                'label' => 'Контент',
                'label_attr' => ['class' => 'label'],
                'attr' => [
                    'class' => 'checkbox'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class
        ]);
    }
}