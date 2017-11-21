<?php
// src/Champloo/SiteBundle/Form/sousCategorieType.php

namespace Champloo\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class sousCategorieType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('categorie', 'entity', array(
				'class' 	=> 'ChamplooSiteBundle:Categorie',
				'property' 	=> 'nom',
				'multiple'	=> false,
				'expanded'	=> false
				))		
        	->add('nom',			'text')
        	->add('description',		'text')	
        	->add('enregistrer',	'submit')  
        ;
	}
    public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Champloo\SiteBundle\Entity\sousCategorie'
			));
	}

	public function getname()
	{
		return 'champloo_sitebundle_souscategorie';
	}
}