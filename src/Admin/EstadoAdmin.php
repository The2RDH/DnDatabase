<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Estado;

class EstadoAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Estado && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Estado';
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
                'label' => 'Estado vital',
                'header_style' => 'width: 25%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 60%;'
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
            ->with('Datos del Estado', ['class' => 'col-md-8'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Estado (ej: Vivo, Muerto, Desaparecido)',
                    'attr' => ['maxlength' => 255]
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción del estado o implicaciones',
                    'required' => false,
                    'attr' => ['rows' => 3]
                ])
            ->end();
    }
}