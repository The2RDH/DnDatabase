<?php

namespace App\Admin;

use App\Entity\Facciones;
use App\Entity\Jerarquias; 
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class FaccionesAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Facciones && $object->getId()
            ? $object->getNombre()
            : 'Nueva Facción';
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
                'label' => 'Nombre de la Facción',
                'header_style' => 'width: 25%;'
            ])
            ->add('lider', null, [
                'label' => 'Líder',
                'header_style' => 'width: 20%;'
            ])
            ->add('jerarquia', null, [
                'label' => 'Estructura Jerárquica',
                'header_style' => 'width: 15%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 25%;'
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
            ->add('lider', null, ['label' => 'Líder'])
            ->add('jerarquia', null, ['label' => 'Jerarquía']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Identidad de la Facción', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre de la Facción',
                    'attr' => ['maxlength' => 50]
                ])
                ->add('lider', TextType::class, [
                    'label' => 'Nombre del Líder Actual',
                    'required' => false,
                    'attr' => ['maxlength' => 255]
                ])
                ->add('jerarquia', EntityType::class, [
                    'class' => Jerarquias::class,
                    'choice_label' => 'nombre',
                    'label' => 'Tipo de Jerarquía',
                    'placeholder' => 'Selecciona el tipo de orden...',
                    'required' => false,
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 3, 'maxlength' => 255]
                ])
            ->end();
    }
}