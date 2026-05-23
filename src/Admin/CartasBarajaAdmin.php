<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\CartasBaraja; 

class CartasBarajaAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof CartasBaraja && $object->getId()
            ? $object->getNombre()
            : 'Nueva Carta';
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
                'label' => 'Nombre',
                'header_style' => 'width: 30%;'
            ])
            ->add('copias', null, [
                'label' => 'Copias',
                'header_style' => 'text-align: center; width: 15%;',
                'row_align' => 'center'
            ])
            ->add('baraja', null, [
                'label' => 'Baraja',
                'header_style' => 'width: 40%;'
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
            ->add('copias', null, ['label' => 'Copias'])
            ->add('baraja', null, ['label' => 'Baraja']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos de la Carta', ['class' => 'col-md-8'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre',
                    'attr' => ['maxlength' => 255]
                ])
                ->add('baraja', null, [
                    'label' => 'Baraja',
                    'placeholder' => 'Selecciona una baraja...'
                ])
                ->add('imagen', TextType::class, [
                    'label' => 'Imagen de carta',
                    'required' => false,
                    'attr' => ['maxlength' => 255]
                ])
                ->add('copias', IntegerType::class, [
                    'label' => 'Número de Copias',
                    'attr' => ['min' => 0]
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 3, 'maxlength' => 255]
                ])
            ->end();
    }
}