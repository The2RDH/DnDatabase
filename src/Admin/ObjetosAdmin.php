<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter;
use App\Entity\Objetos;

class ObjetosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Objetos && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Objeto';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', null, [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px;',
                'row_align' => 'center',
            ])
            ->add('nombre', null, [
                'label' => 'Nombre',
                'header_style' => 'width: 25%;',
                'editable' => true
            ])
            ->add('tipoObjetos', null, [
                'label' => 'Tipo',
                'header_style' => 'width: 15%;'
            ])
            ->add('rareza', null, [
                'label' => 'Rareza',
                'header_style' => 'width: 15%;',
            ])
            ->add('valor', null, [
                'label' => 'Valor',
                'header_style' => 'width: 10%;',
                'editable' => true
            ])
            ->add('consumible', 'boolean', [
                'label' => 'Consumible',
                'header_style' => 'text-align: center; width: 10%;',
                'row_align' => 'center'
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
            ->add('tipoObjetos', null, ['label' => 'Tipo de Objeto'])
            ->add('rareza', null, ['label' => 'Rareza'])
            ->add('consumible', BooleanFilter::class, ['label' => '¿Es Consumible?']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos del Objeto', ['class' => 'col-md-8'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre',
                    'attr' => ['maxlength' => 50]
                ])
                ->add('valor', TextType::class, [
                    'label' => 'Valor',
                    'required' => false,
                    'attr' => ['maxlength' => 20]
                ])
                ->add('peso', NumberType::class, [
                    'label' => 'Peso',
                    'required' => false
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 3, 'maxlength' => 100]
                ])
            ->end()
            ->with('Clasificación', ['class' => 'col-md-4'])
                ->add('tipoObjetos', null, [
                    'label' => 'Tipo de Objeto',
                    'placeholder' => 'Selecciona un tipo...'
                ])
                ->add('rareza', null, [
                    'label' => 'Rareza',
                    'placeholder' => 'Selecciona una rareza...'
                ])
                ->add('consumible', CheckboxType::class, [
                    'label' => '¿Es Consumible?',
                    'required' => false
                ])
            ->end();
    }
}