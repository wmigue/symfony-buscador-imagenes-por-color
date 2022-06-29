<?php

namespace App\Form;

use App\Entity\Imagenes;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImagenesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', FileType::class, [
                'label' => 'Imagen ',
                'mapped' => false,  /* para que me deje enviar formulario sin actualizar imagen  */
                'data_class' => null,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'ERROR: Por favor, elija una imagen solo en jpg o png.',
                    ])
                ],
            ])
            ->add('texto', TypeTextType::class, [

                'attr' => [
                    'placeholder' => 'referencia',
                    'autocomple' => 'off',
                    'class' => 'form-control',
                    'required' => true,

                ]
            ])
            ->add('alto', TypeTextType::class, [

                'attr' => [
                    'placeholder' => 'alto de la imagen',
                    'autocomple' => 'off',
                    'class' => 'form-control',
                    'required' => true,

                ]
            ])
            ->add('colores', HiddenType::class, [

                'attr' => [
                    'placeholder' => 'colores',
                    'autocomple' => 'off',
                    'class' => 'form-control',
                    'required' => true,

                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Imagenes::class,
        ]);
    }
}
