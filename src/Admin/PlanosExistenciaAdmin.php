<?php

namespace App\Admin;

use App\Entity\PlanosExistencia;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class PlanosExistenciaAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof PlanosExistencia && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Plano de Existencia';
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
                'label' => 'Nombre del Plano',
                'header_style' => 'width: 25%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 60%;'
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
            ->add('nombre', null, ['label' => 'Nombre']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información Básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Plano',
                    'attr' => ['maxlength' => 20, 'placeholder' => 'Ej: Plano Material, Inframundo, Plano Astral...']
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción y Leyes del Plano',
                    'required' => false,
                    'attr' => ['rows' => 3, 'maxlength' => 255, 'placeholder' => 'Describe la naturaleza, atmósfera o reglas físicas de esta dimensión...']
                ])
            ->end();
    }
}