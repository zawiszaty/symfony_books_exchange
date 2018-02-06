<?php

namespace AppBundle\Form;


use AppBundle\Command\EditCategoryCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class EditCategoryForm
 *
 * @package App\Form
 */
final class EditCategoryForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditCategoryCommand::class,
            'csrf_protection' => false,
        ]);
    }
}