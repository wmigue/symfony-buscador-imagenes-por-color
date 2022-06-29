<?php

namespace App\Form;

use App\Entity\Imagenes;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BuscarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color', ColorType::class, [
                'attr' => [
                    'placeholder' => 'color',
                    'autocomple' => 'off',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ])
            ->add('distancia', RangeType::class, [
                'label' => 'Distancia Max.',
                'attr' => [
                    'placeholder' => 'distancia color maxima',
                    'autocomple' => 'off',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Buscar',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'required' => true,
                ]
                
            ]);
    }


}
