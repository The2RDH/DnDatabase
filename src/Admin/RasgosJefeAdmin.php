<?php

namespace App\Admin;

use App\Entity\RasgosJefe;
use App\Entity\Jefes;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class RasgosJefeAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof RasgosJefe && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Rasgo de Jefe';
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
                'label' => 'Nombre del Rasgo',
                'header_style' => 'width: 25%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 45%;'
            ])
            ->add('jefe', null, [
                'label' => 'Jefe Vinculado',
                'header_style' => 'width: 15%;'
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
            ->add('jefe', null, ['label' => 'Jefe']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información Básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Rasgo o Habilidad Pasiva'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción del Efecto',
                    'required' => false,
                    'attr' => ['rows' => 4, 'placeholder' => 'Detalla el comportamiento pasivo de este rasgo...']
                ])
                ->add('jefe', EntityType::class, [
                    'class' => Jefes::class,
                    'choice_label' => 'nombre',
                    'label' => 'Asignar a Jefe',
                    'placeholder' => 'Selecciona el jefe que posee este rasgo...',
                    'required' => false,
                    'attr' => ['class' => 'select2']
                ])
            ->end();
    }
}