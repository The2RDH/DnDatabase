<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\Jefes;
use App\Entity\Razas;
use App\Entity\Clases;
use App\Entity\Estado;
use App\Entity\Estadisticas;

class JefesAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Jefes && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Jefe';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('nombre', null, [
                'label' => 'Nombre',
                'header_style' => 'width: 15%;'
            ])
            ->add('nivel', null, [
                'label' => 'Nivel',
                'header_style' => 'text-align: center; width: 5%;',
                'row_align' => 'center'
            ])
            ->add('raza', null, [
                'label' => 'Raza',
                'header_style' => 'width: 10%;',
                'associated_property' => 'nombre'
            ])
            ->add('clase', null, [
                'label' => 'Clase',
                'header_style' => 'width: 10%;',
                'associated_property' => 'nombre'
            ])
            ->add('estado', null, [
                'label' => 'Estado vital',
                'header_style' => 'width: 10%;',
                'associated_property' => 'nombre'
            ])
            ->add('ataquesJefes', 'many_to_many', [
                'label' => 'Habilidades especiales',
                'header_style' => 'width: 20%;',
                'associated_property' => 'nombre' 
            ])
            ->add('estadisticas', null, [
                'label' => 'ID Estadísticas',
                'row_align' => 'center',
                'header_style' => 'text-align: center; width: 110px;',
                'associated_property' => 'id', 
                'route' => [
                    'name' => 'edit'
                ],
            ])

            ->add('descubierto', 'boolean', [
                'label' => 'Descubierto',
                'header_style' => 'text-align: center; width: 90px;',
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('derrotado', 'boolean', [
                'label' => 'Derrotado',
                'header_style' => 'text-align: center; width: 90px;',
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
            ->add('derrotado', null, ['label' => '¿Está Derrotado?'])
            ->add('descubierto', null, ['label' => '¿Está Descubierto?']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos del Encuentro', ['class' => 'col-md-7'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Jefe',
                    'attr' => ['maxlength' => 30]
                ])
                ->add('nivel', IntegerType::class, [
                    'label' => 'Nivel / Desafío'
                ])
                ->add('descubierto', CheckboxType::class, [
                    'label' => 'Visible para los jugadores',
                    'required' => false
                ])
                ->add('derrotado', CheckboxType::class, [
                    'label' => 'Marcado como derrotado en la campaña',
                    'required' => false
                ])
            ->end()
            
            ->with('Rasgos y Estado', ['class' => 'col-md-5'])
                ->add('raza', EntityType::class, [
                    'class' => Razas::class,
                    'label' => 'Raza',
                    'placeholder' => 'Selecciona una raza...',
                    'required' => false
                ])
                ->add('clase', EntityType::class, [
                    'class' => Clases::class,
                    'label' => 'Clase',
                    'placeholder' => 'Selecciona una clase...',
                    'required' => false
                ])
                ->add('estado', EntityType::class, [
                    'class' => Estado::class,
                    'label' => 'Estado Vital',
                    'placeholder' => 'Selecciona el estado...',
                    'required' => false
                ])
                ->add('estadisticas', EntityType::class, [
                    'class' => Estadisticas::class,
                    'label' => 'Hoja de estadísticas (ID)',
                    'placeholder' => 'Selecciona un ID de estadísticas...',
                    'required' => true, 
                    'attr' => ['class' => 'select2'], 
                    'choice_label' => function (Estadisticas $est) {
                        return sprintf(
                            'ID: %d — [FUE: %d | DES: %d | CON: %d | INT: %d | SAB: %d | CAR: %d]',
                            $est->getId(),
                            $est->getFuerza(),
                            $est->getDestreza(),
                            $est->getConstitucion(),
                            $est->getIntelecto(), 
                            $est->getSabiduria(),
                            $est->getCarisma()
                        );
                    },
                ])
            ->end();
    }
}