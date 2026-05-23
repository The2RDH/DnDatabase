<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Inventario;

class InventarioAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Inventario && $object->getId()
            ? sprintf('Inventario de %s (x%d)', $object->getObjeto()?->getNombre() ?? 'Objeto', $object->getCantidad())
            : 'Asignar Nuevo Objeto a Inventario';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', null, [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px;',
                'row_align' => 'center'
            ])
            ->add('personaje', null, [
                'label' => 'Personaje',
                'header_style' => 'width: 35%;'
            ])
            ->add('objeto', null, [
                'label' => 'Objeto',
                'header_style' => 'width: 35%;'
            ])
            ->add('cantidad', null, [
                'label' => 'Cantidad',
                'header_style' => 'text-align: center; width: 15%;',
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
            ->add('personaje', null, ['label' => 'Personaje'])
            ->add('objeto', null, ['label' => 'Objeto'])
            ->add('cantidad', null, ['label' => 'Cantidad']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Asignación de Inventario', ['class' => 'col-md-8'])
                ->add('personaje', null, [
                    'label' => 'Personaje',
                    'placeholder' => 'Selecciona un personaje...'
                ])
                ->add('objeto', null, [
                    'label' => 'Objeto',
                    'placeholder' => 'Selecciona un objeto...'
                ])
                ->add('cantidad', IntegerType::class, [
                    'label' => 'Cantidad',
                    'required' => false,
                    'attr' => ['min' => 0]
                ])
            ->end();
    }
}