<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\AtaquesJefe;
use App\Entity\Jefes;

class AtaquesJefeAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof AtaquesJefe && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Ataque de Jefe';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('nombre', null, [
                'label' => 'Nombre del Ataque',
                'header_style' => 'width: 20%;'
            ])
            ->add('recarga', null, [
                'label' => 'Recarga',
                'header_style' => 'text-align: center; width: 5%;',
                'row_align' => 'center'
            ])
            ->add('danio', null, [
                'label' => 'Dañoss',
                'header_style' => 'text-align: center; width: 30%;',
                'row_align' => 'center',
                'template' => '@SonataAdmin/CRUD/list_string.html.twig',
                'collapse' => true 
            ])
            ->add('salvacion', null, [
                'label' => 'Salvación',
                'header_style' => 'text-align: center; width: 10%;',
                'row_align' => 'center'
            ])
            ->add('objetivos', null, [
                'label' => 'Objetivos',
                'header_style' => 'width: 30%;'
            ])
            ->add('jefe', null, [
                'label' => 'Jefe',
                'header_style' => 'width: 15%;',
                'associated_property' => 'nombre',
                'route' => [
                    'name' => 'edit'
                ],
            ])
            
            ->add('_action', 'actions', [
                'label' => 'Acciones',
                'header_style' => 'text-align: center; width: 120px;',
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre', null, ['label' => 'Nombre del Ataque'])
            ->add('recarga', null, ['label' => 'Tipo de Recarga'])
            ->add('salvacion', null, ['label' => 'Tirada de Salvación'])
            ->add('jefe', ModelFilter::class, [
                'label' => 'Filtrar por Jefe',
                'field_options' => [
                    'class' => Jefes::class,
                    'choice_label' => 'nombre'
                ]
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Definición', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre de la habilidad'
                ])
                ->add('jefe', EntityType::class, [
                    'class' => Jefes::class,
                    'choice_label' => 'nombre',
                    'label' => 'Asignar a Jefe',
                    'placeholder' => 'Selecciona el jefe que posee este ataque...',
                    'required' => false,
                    'attr' => ['class' => 'select2']
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 4, 'placeholder' => 'Detalla qué hace la habilidad, efectos secundarios, estados alterados...']
                ])
            ->end()

            ->with('Mecánicas de Combate', ['class' => 'col-md-6'])
                ->add('recarga', TextType::class, [
                    'label' => 'Recarga',
                    'required' => false,
                    'help' => 'Como recarga el jefe dicha habilidad'
                ])
                ->add('objetivos', TextType::class, [
                    'label' => 'Objetivo',
                    'required' => false,
                    'help' => 'Objetivo de la habilidad (Uno, varios, a si mismo, etc)'
                ])
                ->add('danio', TextType::class, [
                    'label' => 'Daño',
                    'required' => false,
                ])
                ->add('salvacion', TextType::class, [
                    'label' => 'Tirada de Salvación (Si aplica)',
                    'required' => false,
                ])
            ->end();
    }
}