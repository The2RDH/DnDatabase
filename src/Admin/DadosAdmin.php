<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Dados;

class DadosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Dados && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Dado';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', null, [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px;',
                'row_align' => 'center'
            ])
            ->addIdentifier('nombre', null, [
                'label' => 'Dado',
                'header_style' => 'width: 15%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 70%;'
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
            ->add('descripcion', null, ['label' => 'Descripción']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Configuración de Dados', ['class' => 'col-md-8'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Dado (ej: d20, d6)',
                    'attr' => ['maxlength' => 10]
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 4]
                ])
            ->end();
    }
}