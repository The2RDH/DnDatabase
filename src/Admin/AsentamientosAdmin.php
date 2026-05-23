<?php

namespace App\Admin;

use App\Entity\Asentamientos;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class AsentamientosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Asentamientos && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Asentamiento';
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
                'label' => 'Nombre',
                'header_style' => 'width: 25%;'
            ])
            ->add('poblacion', null, [
                'label' => 'Población Estimada',
                'header_style' => 'width: 20%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 40%;'
            ])
            ->add('_action', 'actions', [
                'label' => 'Acciones',
                'header_style' => 'text-align: center; width: 15%;',
                'row_align' => 'center',
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
            ->add('poblacion', null, ['label' => 'Población']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos del Asentamiento', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Asentamiento',
                    'attr' => ['maxlength' => 20, 'placeholder' => 'Ej: Nueva Esperia, Bastión Gris...']
                ])
                ->add('poblacion', TextType::class, [
                    'label' => 'Densidad / Población',
                    'attr' => ['maxlength' => 20, 'placeholder' => 'Ej: 5,000 hab. o Escasa']
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción corta',
                    'required' => false,
                    'attr' => ['rows' => 4, 'maxlength' => 100, 'placeholder' => 'Puntos de interés, clima o notas del asentamiento...']
                ])
            ->end();
    }
}