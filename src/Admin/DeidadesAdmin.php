<?php

namespace App\Admin;

use App\Entity\Deidades;
use App\Entity\Alineamiento;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class DeidadesAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Deidades && $object->getId()
            ? $object->getNombre()
            : 'Nueva Deidad';
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
                'label' => 'Nombre de la Deidad',
                'header_style' => 'width: 25%;'
            ])
            ->add('alineamiento', null, [
                'label' => 'Alineamiento',
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
            ->add('alineamiento', null, ['label' => 'Alineamiento']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Identidad Divina', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre de la Deidad',
                    'attr' => ['maxlength' => 20]
                ])
                ->add('alineamiento', EntityType::class, [
                    'class' => Alineamiento::class,
                    'choice_label' => 'nombre',
                    'label' => 'Alineamiento',
                    'placeholder' => 'Selecciona el alineamiento...',
                    'required' => false,
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción del Culto o Dogma',
                    'required' => false,
                    'attr' => ['rows' => 4, 'maxlength' => 255]
                ])
            ->end();
    }
}