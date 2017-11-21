<?php
// src/Champloo/SiteBundle/Form/CategorieType.php

namespace Champloo\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder		
        	->add('nom',			'text')
        	->add('description',		'text')	
        	->add('enregistrer',	'submit')  
        ;
	}
    public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Champloo\SiteBundle\Entity\Categorie'
			));
	}

	public function getname()
	{
		return 'champloo_sitebundle_categorie';
	}
}