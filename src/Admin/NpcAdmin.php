<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Npc;
use App\Entity\Razas;
use App\Entity\Clases;
use App\Entity\Especializacion;
use App\Entity\Estado;
use Doctrine\DBAL\Types\BooleanType;

class NpcAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Npc && $object->getId()
            ? $object->getNombre()
            : 'Nuevo NPC';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('nombre', null, [
                'label' => 'Nombre',
                'header_style' => 'width: 20%;'
            ])
            ->add('nivel', null, [
                'label' => 'Nivel',
                'header_style' => 'text-align: center; width: 80px;',
                'row_align' => 'center'
            ])
            ->add('raza', null, [
                'label' => 'Raza',
                'header_style' => 'width: 15%;'
            ])
            ->add('clase', null, [
                'label' => 'Clase',
                'header_style' => 'width: 15%;'
            ])
            ->add('especializacion', null, [
                'label' => 'Especialización',
                'header_style' => 'width: 15%;'
            ])
            ->add('estado', null, [
                'label' => 'Estado',
                'header_style' => 'width: 10%;'
            ])
            ->add('descubierto', 'boolean', [
                'label' => 'Descubierto',
                'header_style' => 'text-align: center; width: 100px;',
                'row_align' => 'center',
                'editable' => true
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
            ->add('nivel', null, ['label' => 'Nivel'])
            ->add('raza', null, ['label' => 'Raza'])
            ->add('clase', null, ['label' => 'Clase'])
            ->add('estado', null, ['label' => 'Estado'])
            ->add('descubierto', null, ['label' => 'Descubierto']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos Básicos', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del NPC'
                ])
                ->add('altura', TextType::class, [
                    'label' => 'Altura',
                    'required' => false
                ])
                ->add('peso', TextType::class, [
                    'label' => 'Peso',
                    'required' => false
                ])
                ->add('imagen', TextType::class, [
                    'label' => 'Ruta de la Imagen',
                    'required' => false
                ])
                ->add('token', TextType::class, [
                    'label' => 'Ruta del Token',
                    'required' => false
                ])
            ->end()

            ->with('Atributos', ['class' => 'col-md-6'])
                ->add('nivel', IntegerType::class, [
                    'label' => 'Nivel',
                    'required' => false
                ])
                ->add('raza', EntityType::class, [
                    'class' => Razas::class,
                    'choice_label' => 'nombre',
                    'label' => 'Raza',
                    'placeholder' => 'Selecciona raza...',
                    'required' => false
                ])
                ->add('clase', EntityType::class, [
                    'class' => Clases::class,
                    'choice_label' => 'nombre',
                    'label' => 'Clase',
                    'placeholder' => 'Selecciona clase...',
                    'required' => false
                ])
                ->add('especializacion', EntityType::class, [
                    'class' => Especializacion::class,
                    'choice_label' => 'nombre',
                    'label' => 'Especialización',
                    'placeholder' => 'Selecciona especialización...',
                    'required' => false
                ])
            ->end()

            ->with('Información Relevante', ['class' => 'col-md-6'])
                ->add('estado', EntityType::class, [
                    'class' => Estado::class,
                    'choice_label' => 'nombre',
                    'label' => 'Estado actual',
                    'placeholder' => 'Selecciona el estado actual',
                    'required' => false
                ])
                ->add('descubierto', CheckboxType::class, [
                    'label' => '¿Ha sido descubierto por los jugadores?',
                    'required' => false,
                    'help' => 'Si se marca, aparecerá visible en el códice o el diario de los jugadores.'
                ])
            ->end();
    }
}