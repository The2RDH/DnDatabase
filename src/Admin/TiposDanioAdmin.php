<?php

namespace App\Admin;

use App\Entity\TiposDanio;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class TiposDanioAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof TiposDanio && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Tipo de Daño';
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
                'label' => 'Tipo de Daño',
                'header_style' => 'width: 25%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 45%;'
            ])
            ->add('magico', null, [
                'label' => '¿Es Mágico?',
                'header_style' => 'text-align: center; width: 15%;',
                'row_align' => 'center',
                'editable' => true
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
            ->add('magico', null, ['label' => 'Es Mágico']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información Básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre',
                    'attr' => ['maxlength' => 20, 'placeholder' => 'Ej: Fuego, Cortante, Sagrado...']
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 3, 'maxlength' => 100, 'placeholder' => 'Breve explicación de la naturaleza de este daño...']
                ])
                ->add('magico', CheckboxType::class, [
                    'label' => 'Es daño mágico',
                    'required' => false
                ])
            ->end();
    }
}