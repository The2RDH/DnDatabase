<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Razas;
use App\Entity\Origen;
use App\Entity\Rasgos;

class RazasAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Razas && $object->getId()
            ? $object->getNombre()
            : 'Nueva Raza';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->addIdentifier('nombre', null, [
                'label' => 'Raza',
                'header_style' => 'width: 20%;'
            ])
            ->add('origen', null, [
                'label' => 'Origen / Procedencia',
                'header_style' => 'width: 20%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 45%;'
            ])
            ->add('_action', 'actions', [
                'label' => 'Acciones',
                'header_style' => 'text-align: center; width: 15%;',
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre', null, ['label' => 'Nombre de la Raza'])
            ->add('origen', null, ['label' => 'Lugar de Origen']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre de la Raza'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Trasfondo / Descripción',
                    'required' => false,
                    'attr' => ['rows' => 4]
                ])
                ->add('token', TextType::class, [
                    'label' => 'URL o Ruta del Token',
                    'required' => false
                ])
            ->end()

            ->with('Características', ['class' => 'col-md-6'])
                ->add('origen', EntityType::class, [
                    'class' => Origen::class,
                    'choice_label' => 'nombre', 
                    'label' => 'Región o Lugar de Origen',
                    'placeholder' => 'Lugar de procedencia...',
                    'required' => false, 
                ])
                ->add('rasgos', EntityType::class, [
                    'class' => Rasgos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Rasgos Raciales',
                    'multiple' => true,   
                    'expanded' => false, 
                    'required' => false,     
                    'attr' => [
                        'class' => 'select2-target'
                    ]
                ])
            ->end();
    }
}