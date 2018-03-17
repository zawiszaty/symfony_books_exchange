<?php

namespace AppBundle\Form;


use AppBundle\Book\Command\EditBookCommand;
use AppBundle\Category\Command\EditCategoryCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class EditCategoryForm
 *
 * @package App\Form
 */
final class EditBookForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idBook')
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('lat')
            ->add('lng')
            ->add('type');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditBookCommand::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ]);
    }
}