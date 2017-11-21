<?php
// src/Champloo/TaxonomieBundle/Form/SmartlinkType.php

namespace Champloo\TaxonomieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SmartlinkType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder	     	
        	->add('lien', 'text')
           	;
	}
    public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Champloo\TaxonomieBundle\Entity\Smartlink'
			));
	}

	public function getname()
	{
		return 'champloo_taxonomiebundle_smartlink';
	}
}