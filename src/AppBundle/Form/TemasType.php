<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TemasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreTema', TextType::class, ['error_bubbling' => true, 'attr' => ['class' => 'anyClass']])
            ->add('textoTema', TextareaType::class, ['error_bubbling' => true]) //text area caja coment grande

            ->add('prodFile', VichImageType::class,[
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ])



            ->add('save', SubmitType::class,
                    array('label'=>'Send'))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Temas',
            ]
        );
    }

    public function getName()
    {
        return 'app_bundle_temas_type';
    }
}
