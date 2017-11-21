<?php
// src/Champloo/SiteBundle/Form/ArticleType.php

namespace Champloo\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
		   	->add('titre',			'text')
        	->add('contenu',		'textarea')
        	->add('nomfr',			'text', array('required' => false))
        	->add('nomvo',			'text', array('required' => false))
        	->add('horaire',		'textarea', array('required' => false))
        	->add('prix',			'textarea', array('required' => false))
        	->add('adresse',		'textarea', array('required' => false))
        	->add('telephone',		'text', array('required' => false))
        	->add('acces',			'textarea', array('required' => false))
        	->add('url',			'url', array(
        		'default_protocol' => 'http', 'required' => false))
        	->add('email',			'email', array('required' => false))
        	->add('enregistrer',	'submit')
        	;
	}
    public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Champloo\SiteBundle\Entity\Article'
			));
	}

	public function getname()
	{
		return 'champloo_sitebundle_article';
	}
}