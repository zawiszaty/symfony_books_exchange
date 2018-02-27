<?php


namespace AppBundle\Form;

use AppBundle\Offer\Command\AcceptedOfferCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AcceptedOfferForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idoffer')
            ->add('requiredUser');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AcceptedOfferCommand::class,
            'csrf_protection' => false,
        ]);
    }
}