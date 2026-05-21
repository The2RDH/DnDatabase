<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Recursos;

class RecursosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Recursos && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Recurso';
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
                'label' => 'Recurso',
                'header_style' => 'width: 25%;'
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
            ->add('nombre', null, ['label' => 'Nombre del Recurso']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información básica', ['class' => 'col-md-12'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Recurso'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripcion',
                    'required' => false,
                    'attr' => ['rows' => 3]
                ])
            ->end();
    }
}