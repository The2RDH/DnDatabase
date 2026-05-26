<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Filter\ModelFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Enemigos;
use App\Entity\Clases;
use App\Entity\Especializacion;
use App\Entity\Razas;
use App\Entity\GrupoEnemigos;
use App\Entity\TipoEnemigos;
use App\Entity\Estadisticas;

class EnemigosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Enemigos && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Enemigo';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('nombre', null, [
                'label' => 'Nombre',
                'header_style' => 'width: 20%;'
            ])
            ->add('nivel', null, [
                'label' => 'Desafío',
                'header_style' => 'text-align: center; width: 5%;',
                'row_align' => 'center'
            ])
            ->add('clase', null, [
                'label' => 'Clase',
                'header_style' => 'width: 15%;',
                'associated_property' => 'nombre'
            ])
            ->add('raza', null, [
                'label' => 'Razas',
                'header_style' => 'width: 15%;',
                'associated_property' => 'nombre'
            ])
            ->add('tipo', null, [
                'label' => 'Tipos',
                'header_style' => 'width: 15%;',
                'associated_property' => 'nombre'
            ])
            ->add('descubierto', 'boolean', [
                'label' => 'Avistado',
                'header_style' => 'text-align: center; width: 5%;',
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('analizado', 'boolean', [
                'label' => 'Analizado',
                'header_style' => 'text-align: center; width: 5%;',
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('estadisticas', null, [
                'label' => 'Estadísticas',
                'row_align' => 'center',
                'header_style' => 'text-align: center; width: 5%;',
                'associated_property' => 'id', 
                'route' => [
                    'name' => 'edit'
                ],
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
            ->add('clase', ModelFilter::class, [
                'label' => 'Clase',
                'field_options' => [
                    'class' => Clases::class,
                    'choice_label' => 'nombre'
                ]
            ])
            ->add('raza', ModelFilter::class, [ 
                'label' => 'Raza',
                'field_options' => [
                    'class' => Razas::class,
                    'choice_label' => 'nombre'
                ]
            ]) 
            ->add('tipo', ModelFilter::class, [
                'label' => 'Tipo de Criatura',
                'field_options' => [
                    'class' => TipoEnemigos::class,
                    'choice_label' => 'nombre'
                ]
            ]) 
            ->add('grupo', ModelFilter::class, [
                'label' => 'Facción / Grupo',
                'field_options' => [
                    'class' => GrupoEnemigos::class,
                    'choice_label' => 'nombre'
                ]
            ])  
            ->add('descubierto', null, ['label' => '¿Descubierto por PJ?'])
            ->add('analizado', null, ['label' => '¿Analizado?']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Información básica', ['class' => 'col-md-5'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre de la criatura'
                ])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 5]
                ])
                ->add('imagen', TextType::class, [
                    'label' => 'Imagen',
                    'required' => false
                ])
                ->add('token', TextType::class, [
                    'label' => 'Token',
                    'required' => false
                ])
            ->end()

            ->with('Información relevante',  ['class' => 'col-md-6'])    
                ->add('descubierto', CheckboxType::class, [
                    'label' => '¿Descubierto?',
                    'required' => false
                ])    
                ->add('analizado', CheckboxType::class, [
                    'label' => '¿Analizado por los jugadores?',
                    'required' => false
                ])    
                ->add('tipo', EntityType::class, [
                    'class' => TipoEnemigos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Tipo de Enemigo',
                    'multiple' => true,
                    'required' => false,
                    'by_reference' => false
                ])
                ->add('grupo', EntityType::class, [
                    'class' => GrupoEnemigos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Facciones o Grupos Vinculados',
                    'multiple' => true,
                    'required' => false,
                    'by_reference' => false
                ])
            ->end()

            ->with('Características', ['class' => 'col-md-12'])
                ->add('nivel', TextType::class, [
                    'label' => 'Nivel o Desafío',
                    'required' => false
                ])
                ->add('clase', EntityType::class, [
                    'class' => Clases::class,
                    'choice_label' => 'nombre',
                    'label' => 'Clase',
                    'placeholder' => 'Selecciona estilo...',
                ])
                ->add('especializacion', EntityType::class, [
                    'class' => Especializacion::class,
                    'choice_label' => 'nombre',
                    'label' => 'Especialización',
                    'placeholder' => 'Sin especialización...',
                    'required' => false
                ])
                ->add('raza', EntityType::class, [
                    'class' => Razas::class,
                    'choice_label' => 'nombre',
                    'label' => 'Razas',
                    'multiple' => true,
                    'required' => false,
                    'property_path' => 'razas' 
                ])
                ->add('estadisticas', EntityType::class, [
                    'class' => Estadisticas::class,
                    'label' => 'Bloque de estadísticas (ID)',
                    'placeholder' => 'Selecciona el bloque de estadísticas...',
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
                ->add('fortalezas', TextareaType::class, [
                    'label' => 'Fortalezas (Inmunidades, resistencias, rasgos únicos...)',
                    'required' => false,
                    'attr' => ['rows' => 4, 'placeholder' => 'Ej: Inmune a fuego, ventaja en tiradas de percepción...']
                ])
                ->add('debilidades', TextareaType::class, [
                    'label' => 'Debilidades (Vulnerabilidades, penalizadores...)',
                    'required' => false,
                    'attr' => ['rows' => 4, 'placeholder' => 'Ej: Vulnerable a daño sagrado, sufre ceguera en la luz...']
                ])  
            ->end();            
    }
}