<?php

namespace UserBundle\Form;
use SuiviBundle\Entity\Classe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('classe',EntityType::class,[
            'class'=>Classe::class,
            'label' => false,


            'required'=>false,
            'choice_label'=>'libelle'
            ]);
        $builder->add('roles', ChoiceType::class, array(
                'choices'=> array(

                    'Eleve'   => 'Eleve',
                    'Enseignant'   => 'Enseignant',
                    'Admin'   => 'Admin',
                ),
                'multiple' => true,
                'required' => true,
            )
        );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }

}