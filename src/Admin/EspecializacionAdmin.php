<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Especializacion;
use App\Entity\Clases;
use App\Entity\Recursos;

class EspecializacionAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Especializacion && $object->getId()
            ? $object->getNombre()
            : 'Nueva Especialización';
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
                'label' => 'Especialización',
                'header_style' => 'width: 20%;'
            ])
            ->add('clase', null, [
                'label' => 'Clase',
                'header_style' => 'width: 15%;'
            ])
            // CAMBIO: Apuntamos a 'recursos' (plural) y Sonata pintará la colección automáticamente
            ->add('recursos', null, [
                'label' => 'Recursos',
                'header_style' => 'width: 15%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 35%;'
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
            ->add('nombre', null, ['label' => 'Especialización'])
            ->add('clase', null, ['label' => 'Clase'])
            // CAMBIO: El filtro debe buscar sobre la relación en plural 'recursos'
            ->add('recursos', null, ['label' => 'Recursos']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Arquetipo / Especialización'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción corta',
                    'required' => false,
                    'attr' => ['rows' => 4]
                ])
            ->end()

            ->with('Características', ['class' => 'col-md-6'])
                ->add('clase', EntityType::class, [
                    'class' => Clases::class,
                    'choice_label' => 'nombre',
                    'label' => 'Pertenece a la Clase Base',
                    'placeholder' => 'Selecciona clase...',
                ])
                ->add('recursos', EntityType::class, [
                    'class' => Recursos::class,
                    'multiple' => true,
                    'expanded' => false,
                    'choice_label' => 'nombre',
                    'label' => 'Recursos que utiliza',
                ])
            ->end();
    }
}