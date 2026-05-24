<?php

namespace App\Admin;

use App\Entity\OfertaComercial;
use App\Entity\Objetos;
use App\Entity\Npc;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

final class OfertaComercialAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof OfertaComercial && $object->getId()
            ? sprintf('%s vende %s (%d uds)', 
                $object->getNpc() ? $object->getNpc()->getNombre() : 'NPC Desconocido',
                $object->getObjeto() ? $object->getObjeto()->getNombre() : 'Objeto',
                $object->getCantidad()
              )
            : 'Nueva Oferta Comercial';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->add('npc', null, [
                'label' => 'Comerciante / NPC',
                'header_style' => 'width: 20%;'
            ])
            ->add('objeto', null, [
                'label' => 'Artículo en Venta',
                'header_style' => 'width: 40%;'
            ])
            ->add('precio', 'currency', [
                'label' => 'Oro',
                'header_style' => 'text-align: center; width: 5%;',
                'row_align' => 'center',
            ])
            ->add('cantidad', 'integer', [
                'label' => 'Stock',
                'header_style' => 'text-align: center; width: 10%;',
                'row_align' => 'center'
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
            ->add('npc', null, ['label' => 'Vendedor (NPC)'])
            ->add('objeto', null, ['label' => 'Artículo'])
            ->add('precio', null, ['label' => 'Precio máximo']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos del objeto a la venta', ['class' => 'col-md-12'])
                ->add('precio', NumberType::class, [
                    'label' => 'Precio de Venta',
                    'scale' => 2,
                    'attr' => ['min' => 0, 'step' => '0.01', 'placeholder' => 'Ej: 49.99']
                ])
                ->add('cantidad', IntegerType::class, [
                    'label' => 'Cantidad / Stock Inicial',
                    'attr' => ['min' => 0, 'placeholder' => 'Ej: 5 (0 para infinito o sin stock)']
                ])
                ->add('npc', EntityType::class, [
                    'class' => Npc::class,
                    'choice_label' => 'nombre',
                    'label' => 'NPC que ofrece el artículo',
                    'placeholder' => 'Selecciona el comerciante...',
                    'required' => false,
                ])
                ->add('objeto', EntityType::class, [
                    'class' => Objetos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Objeto ofertado',
                    'placeholder' => 'Selecciona el artículo...',
                    'required' => false,
                ])
            ->end();
    }
}