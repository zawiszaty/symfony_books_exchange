<?php


namespace AppBundle\Form;

use AppBundle\Offer\Command\RejectedOfferCommand;
use AppBundle\Offer\Command\SeenOfferCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SeenOfferForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idoffer');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SeenOfferCommand::class,
            'csrf_protection' => false,
        ]);
    }
}