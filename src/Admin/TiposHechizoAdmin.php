<?php

namespace App\Admin;

use App\Entity\TiposHechizo;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class TiposHechizoAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof TiposHechizo && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Tipo de Hechizo';
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
                'label' => 'Nombre del Tipo',
                'header_style' => 'width: 25%;'
            ])
            ->add('efecto', null, [
                'label' => 'Efecto General',
                'header_style' => 'width: 30%;'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción',
                'header_style' => 'width: 30%;'
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
            ->add('nombre', null, ['label' => 'Nombre']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información Básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Tipo de Hechizo',
                    'attr' => ['placeholder' => 'Ej: Evocación, Curación, Alteración...']
                ])
                ->add('efecto', TextType::class, [
                    'label' => 'Efecto base común',
                    'required' => false,
                    'attr' => ['placeholder' => 'Ej: Daño en área, recuperación de atributos...']
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción del funcionamiento',
                    'required' => false,
                    'attr' => ['rows' => 4, 'placeholder' => 'Define las reglas generales o el lore de este tipo de magias...']
                ])
            ->end();
    }
}