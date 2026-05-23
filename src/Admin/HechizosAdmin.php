<?php

namespace App\Admin;

use App\Entity\Hechizos;
use App\Entity\TiposHechizo; 
use App\Entity\EscuelasMagia;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class HechizosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Hechizos && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Hechizo';
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
                'label' => 'Nombre del Hechizo',
                'header_style' => 'width: 20%;'
            ])
            ->add('coste', null, [
                'label' => 'Coste',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->add('tipo', null, [
                'label' => 'Tipo',
                'header_style' => 'width: 12%;'
            ])
            ->add('escuela', null, [
                'label' => 'Escuela',
                'header_style' => 'width: 12%;'
            ])
            ->add('duracion', null, [
                'label' => 'Duración',
                'header_style' => 'width: 15%;'
            ])
            ->add('verbal', null, [
                'label' => 'Ver.',
                'header_style' => 'text-align: center;',
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('somatico', null, [
                'label' => 'Som.',
                'header_style' => 'text-align: center;',
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('material', null, [
                'label' => 'Mat.',
                'header_style' => 'text-align: center;',
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('canalizado', null, [
                'label' => 'Canal.',
                'header_style' => 'text-align: center;',
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
            ->add('tipo', null, ['label' => 'Tipo de Hechizo'])
            ->add('escuela', null, ['label' => 'Escuela de Magia'])
            ->add('canalizado', null, ['label' => 'Canalizado']);
    }

    protected function configureFormFields(FormMapper $form): void
{
    $form
        ->with('Información básica', ['class' => 'col-md-6'])
            ->add('nombre', TextType::class, [
                'label' => 'Nombre del Hechizo'
            ])
            ->add('efectos', TextareaType::class, [
                'label' => 'Efectos mecánicos',
                'required' => false,
                'attr' => ['rows' => 2, 'placeholder' => '¿Qué hace numéricamente el hechizo?']
            ])
            ->add('descripcion', TextareaType::class, [
                'label' => 'Descripción narrativa',
                'required' => false,
                'attr' => ['rows' => 3, 'placeholder' => 'Lore o descripción visual del conjuro...']
            ])
            ->add('duracion', TextType::class, [
                'label' => 'Duración',
                'required' => false,
                'attr' => ['placeholder' => 'Ej: Instantáneo, 1 minuto, Hasta ser disipado...']
            ])
            ->add('tipo', EntityType::class, [
                'class' => TiposHechizo::class,
                'choice_label' => 'nombre',
                'label' => 'Tipo de Hechizo',
                'placeholder' => 'Selecciona el tipo...', 
                'required' => false,
            ])
            ->add('escuela', EntityType::class, [
                'class' => EscuelasMagia::class,
                'choice_label' => 'nombre',
                'label' => 'Escuela de Magia',
                'placeholder' => 'Selecciona la escuela...', 
                'required' => false,
            ])
        ->end()

        ->with('Coste de lanzamiento', ['class' => 'col-md-6'])
            ->add('coste', IntegerType::class, [
                'label' => 'Coste de Maná',
                'attr' => ['min' => 0]
            ])
            ->add('costeExtra', TextType::class, [
                'label' => 'Coste Adicional / Requisitos extra',
                'required' => false,
                'attr' => ['placeholder' => 'Ej: Sacrificio de vida, componentes raros...']
            ])
            ->add('canalizado', CheckboxType::class, [
                'label' => '¿Requiere canalización continuada?',
                'required' => false
            ])
            ->add('verbal', CheckboxType::class, [
                'label' => 'Componente Verbal (Requiere hablar)',
                'required' => false
            ])
            ->add('somatico', CheckboxType::class, [
                'label' => 'Componente Somático (Requiere gesticular)',
                'required' => false
            ])
            ->add('material', CheckboxType::class, [
                'label' => 'Componente Material (Requiere objetos físicos)',
                'required' => false
            ])
        ->end();
}
}