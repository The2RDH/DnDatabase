<?php

namespace App\Admin;

use App\Entity\Lugares;
use App\Entity\Regiones;       // Ajusta el nombre de tus entidades reales si varían
use App\Entity\Asentamientos;
use App\Entity\TipoLugar;
use App\Entity\Terrenos;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class LugaresAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Lugares && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Lugar';
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
                'label' => 'Nombre del Lugar',
                'header_style' => 'width: 20%;'
            ])
            ->add('region', null, [
                'label' => 'Región',
                'header_style' => 'width: 15%;'
            ])
            ->add('asentamiento', null, [
                'label' => 'Tamaño',
                'header_style' => 'width: 15%;'
            ])
            ->add('tipoLugar', null, [
                'label' => 'Tipo de Lugar',
                'header_style' => 'width: 15%;'
            ])
            ->add('terreno', null, [
                'label' => 'Terreno',
                'header_style' => 'width: 15%;'
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
            ->add('region', null, ['label' => 'Región'])
            ->add('asentamiento', null, ['label' => 'Tamaño'])
            ->add('tipoLugar', null, ['label' => 'Tipo de Lugar'])
            ->add('terreno', null, ['label' => 'Tipo de Terreno']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos básicos', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre de la Ubicación o Punto de Interés',
                    'attr' => ['maxlength' => 255, 'placeholder' => 'Ej: Cueva de los Susurros, Torre de Vigilancia...']
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción o Trasfondo',
                    'required' => false,
                    'attr' => ['rows' => 4, 'maxlength' => 255, 'placeholder' => 'Notas sobre lo que se puede encontrar en este sitio...']
                ])
            ->end()

            ->with('Datos Geográficos', ['class' => 'col-md-6'])
                ->add('region', EntityType::class, [
                    'class' => Regiones::class,
                    'choice_label' => 'nombre',
                    'label' => 'Región a la que pertenece',
                    'placeholder' => 'Selecciona la región...',
                    'required' => false,
                ])
                ->add('asentamiento', EntityType::class, [
                    'class' => Asentamientos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Tamaño',
                    'placeholder' => 'Selecciona el tamaño...',
                    'required' => false,
                ])
                ->add('tipoLugar', EntityType::class, [
                    'class' => TipoLugar::class,
                    'choice_label' => 'nombre',
                    'label' => 'Tipo de Lugar',
                    'placeholder' => 'Selecciona el tipo...',
                    'required' => false,
                ])
                ->add('terreno', EntityType::class, [
                    'class' => Terrenos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Bioma / Terreno predominante',
                    'placeholder' => 'Selecciona el terreno...',
                    'required' => false,
                ])
            ->end();
    }
}