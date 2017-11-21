<?php
// src/Champloo/TaxonomieBundle/Form/TermeType.php

namespace Champloo\TaxonomieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TermeType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
	     	->add('title',			'text')
        	->add('description',	'textarea')
        	->add('lien',			'text', array('required' => false)) // l'option 'required' permet de laisser le champ vide
        	->add('enregistrer',	'submit')
        	;
	}
    public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Champloo\TaxonomieBundle\Entity\Terme'
			));
	}

	public function getname()
	{
		return 'champloo_taxonomiebundle_terme';
	}
}