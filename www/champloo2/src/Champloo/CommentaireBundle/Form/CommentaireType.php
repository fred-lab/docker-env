<?php
// src/Champloo/CommentaireBundle/Form/CommentaireType.php

namespace Champloo\CommentaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
        	->add('contenu',		'textarea')        	
        	->add('enregistrer',	'submit')
        	;
	}
    public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'Champloo\CommentaireBundle\Entity\Commentaire'
			));
	}

	public function getname()
	{
		return 'champloo_commentairebundle_commentaire';
	}
}