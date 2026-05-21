<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Rasgos;
use App\Entity\Razas;

class RasgosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Rasgos && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Rasgo';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->addIdentifier('nombre', null, [
                'label' => 'Nombre del Rasgo',
                'header_style' => 'width: 15%;'
            ])
            // Opcional: Mostramos a qué razas afecta este rasgo directamente en la lista
            ->add('razas', null, [
                'label' => 'Rasgo de...',
                'header_style' => 'width: 20%;',
                'associated_property' => 'nombre'
            ])
            ->add('descripcion', null, [
                'label' => 'Efecto / Descripción',
                'header_style' => 'width: 45%;'
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
            ->add('nombre', null, ['label' => 'Nombre del Rasgo'])
            ->add('razas', null, ['label' => 'Asociado a la Raza']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Características', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Rasgo'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción / Efecto',
                    'required' => false,
                    'attr' => ['rows' => 4]
                ])
            ->end()

            // Para permitir agregar los rasgos a las razas desde el editor
            ->with('Asignar a Razas', ['class' => 'col-md-6'])
                ->add('razas', EntityType::class, [
                    'class' => Razas::class,
                    'choice_label' => 'nombre',
                    'label' => 'Razas vinculadas',
                    'multiple' => true,
                    'expanded' => false,  // Selector múltiple cómodo
                    'required' => false,
                    'by_reference' => false,  // Clave en Doctrine para que use addRaza() / removeRaza() correctamente
                ])
            ->end();
    }
}