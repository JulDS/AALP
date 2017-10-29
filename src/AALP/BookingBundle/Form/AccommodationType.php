<?php

namespace AALP\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
//use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
//use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\TextType;
//use AALP\BookingBundle\Repository\ImageRepository;
//use AALP\BookingBundle\Form\ImageType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AccommodationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('reference')
			->add('name')
			->add('parent')
			->add('bookable')
			->add('description')
			->add('room')
			->add('version')
			->add('start')
			->add('end')
			->add('price')
			->add('state')
			->add('simplebed')
			->add('doublebed')
			->add('creation')
			->add('site')
			
			->add('images',CollectionType::class, array(
			     'entry_type'=>ImageType::class,
				 'allow_add'=>true,
				 'allow_delete'=>true
				 ))
			
			->add('save', SubmitType::class);
	}
    
    /**	
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AALP\BookingBundle\Entity\Accommodation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'aalp_bookingbundle_accommodation';
    }


}
