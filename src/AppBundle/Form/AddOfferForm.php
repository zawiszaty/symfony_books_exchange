<?php


namespace AppBundle\Form;

use AppBundle\Offer\Command\AddOfferCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddOfferForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('offeredBook')
            ->add('requiredBook')
            ->add('offeredUser')
            ->add('requiredUser');

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddOfferCommand::class,
            'csrf_protection' => false,
        ]);
    }
}