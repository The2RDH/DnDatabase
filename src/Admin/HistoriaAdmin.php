<?php

namespace App\Admin;

use App\Entity\Historia;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class HistoriaAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Historia && $object->getId()
            ? $object->getTitulo()
            : 'Nuevo Fragmento de Historia';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->add('titulo', null, [
                'label' => 'Título de la Crónica / Relato',
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
            ->add('titulo', null, ['label' => 'Título']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos del Relato', ['class' => 'col-md-12'])
                ->add('titulo', TextType::class, [
                    'label' => 'Título del Fragmento',
                    'attr' => ['maxlength' => 255]
                ])
                ->add('fragmento', TextareaType::class, [
                    'label' => 'Cuerpo de la Historia',
                    'required' => false,
                    'attr' => ['rows' => 25, 'placeholder' => 'Escribe o pega aquí el fragmento de lore o relato completo...']
                ])
            ->end();
    }
}