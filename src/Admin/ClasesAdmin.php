<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Clases;
use App\Entity\TipoClase;
use App\Entity\Recursos;


class ClasesAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Clases && $object->getId()
            ? $object->getNombre()
            : 'Nueva Clase';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->add('nombre', null, [
                'label' => 'Nombre de la Clase',
                'header_style' => 'width: 15%;'
            ])
            ->add('recurso', null, [
                'label' => 'Recurso',
                'header_style' => 'width: 15%'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 50%;'
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
            ->add('nombre', null, ['label' => 'Nombre'])
            ->add('tipoClase', null, ['label' => 'Tipo de Clase'])
            ->add('recurso', null, ['label' => 'Recurso']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información Básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre de la Clase'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción corta',
                    'required' => false,
                    'attr' => ['rows' => 3]
                ])
                ->add('token', TextType::class, [
                    'label' => 'URL o Ruta del Token visual',
                    'required' => false
                ])
            ->end()

            ->with('Características', ['class' => 'col-md-6'])
                ->add('tipoClase', EntityType::class, [
                    'class' => TipoClase::class,
                    'choice_label' => 'nombre',
                    'label' => 'Tipo de Clase',
                    'placeholder' => 'Selecciona el arquetipo...',
                ])
                ->add('recurso', EntityType::class, [
                    'class' => Recursos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Recurso de Clase',
                    'placeholder' => 'Sin recurso',
                    'required' => false, 
                ])
            ->end();
    }
}