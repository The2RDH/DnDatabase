<?php

namespace App\Admin;

use App\Entity\Idiomas;
use App\Entity\Origen; // Ajusta el nombre de tu entidad real si varía
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class IdiomasAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Idiomas && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Idioma';
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
                'label' => 'Idioma',
                'header_style' => 'width: 15%;'
            ])
            ->add('origen', null, [
                'label' => 'Origen',
                'header_style' => 'width: 15%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 55%;'
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
            ->add('nombre', null, ['label' => 'Idioma'])
            ->add('origen', null, ['label' => 'Origen']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos Lingüísticos', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Idioma',
                    'attr' => ['maxlength' => 20]
                ])
                ->add('origen', EntityType::class, [
                    'class' => Origen::class,
                    'choice_label' => 'nombre',
                    'label' => 'Origen',
                    'placeholder' => 'Selecciona el origen raíz...',
                    'required' => false,
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 4, 'maxlength' => 255]
                ])
            ->end();
    }
}