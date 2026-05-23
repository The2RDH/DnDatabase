<?php

namespace App\Admin;

use App\Entity\GrupoEnemigos;
use App\Entity\Facciones;
use App\Entity\Religiones;
use App\Entity\Enemigos;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class GrupoEnemigosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof GrupoEnemigos && $object->getId()
            ? $object->getNombre()
            : 'Nueva Agrupación';
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
                'label' => 'Nombre del Grupo',
                'header_style' => 'width: 20%;'
            ])
            ->add('faccion', null, [
                'label' => 'Facción',
                'header_style' => 'width: 15%;'
            ])
            ->add('religion', null, [
                'label' => 'Religión',
                'header_style' => 'width: 15%;'
            ])
            ->add('descubierto', null, [
                'label' => 'Descubierto',
                'header_style' => 'text-align: center; width: 10%;',
                'row_align' => 'center',
                'editable' => true
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
            ->add('descubierto', null, ['label' => 'Descubierto'])
            ->add('faccion', null, ['label' => 'Facción'])
            ->add('religion', null, ['label' => 'Religión']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información Básica', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Grupo'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 3]
                ])
                ->add('descubierto', CheckboxType::class, [
                    'label' => '¿Está descubierto?',
                    'required' => false
                ])
            ->end()

            ->with('Alineamiento y Composición', ['class' => 'col-md-6'])
                ->add('faccion', EntityType::class, [
                    'class' => Facciones::class,
                    'choice_label' => 'nombre',
                    'label' => 'Facción',
                    'placeholder' => 'Selecciona una facción...',
                    'required' => false,
                ])
                ->add('religion', EntityType::class, [
                    'class' => Religiones::class,
                    'choice_label' => 'nombre',
                    'label' => 'Religión',
                    'placeholder' => 'Selecciona una religión...',
                    'required' => false,
                ])
                ->add('enemigos', EntityType::class, [
                    'class' => Enemigos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Enemigos integrantes',
                    'multiple' => true,
                    'required' => false,
                    'by_reference' => false,
                ])
            ->end();
    }
}