<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Personaje;
use App\Entity\Clases;
use App\Entity\Razas;
use App\Entity\Alineamiento;
use App\Entity\Jugadores;
use App\Entity\Estadisticas;

class PersonajeAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Personaje && $object->getId()
            ? $object->getNombreCompleto()
            : 'Nuevo Personaje';
    }
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center',
            ])
            ->add('nombre', null, [
                'label' => 'Nombre',
                'header_style' => 'width: 20%;'
            ])
            ->add('nivel', 'integer', [
                'label' => 'Nivel',
                'row_align' => 'center',
                'header_style' => 'text-align: center; width: 80px;'
            ])
            ->add('clase.nombre', null, [
                'label' => 'Clase',
                'header_style' => 'width: 15%;'
            ])
            ->add('raza.nombre', null, [
                'label' => 'Raza',
                'header_style' => 'width: 15%;'
            ])
            ->add('jugador.nombre', null, [
                'label' => 'Jugador',
                'header_style' => 'width: 15%;'
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
            ->add('apellido', null, ['label' => 'Apellido'])
            ->add('nivel', null, ['label' => 'Nivel'])
            ->add('clase', null, ['label' => 'Clase'])
            ->add('jugador', null, ['label' => 'Jugador']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Características del Personaje', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, ['label' => 'Nombre'])
                ->add('apellido', TextType::class, [
                    'label' => 'Apellido', 
                    'required' => false
                ])
                ->add('edad', TextType::class, ['label' => 'Edad', 'required' => false])
                ->add('altura', TextType::class, ['label' => 'Altura (M)', 'required' => false])
                ->add('peso', TextType::class, ['label' => 'Peso (Kg)', 'required' => false])
                ->add('originario', TextType::class, [
                    'label' => 'Lugar de Origen / Procedencia',
                    'required' => false
                ])
                ->add('alineamiento', EntityType::class, [
                    'class' => Alineamiento::class,
                    'choice_label' => 'nombre',
                    'label' => 'Alineamiento',
                    'placeholder' => 'Selecciona alineamiento...',
                    'required' => false
                ])
                ->add('jugador', EntityType::class, [
                    'class' => Jugadores::class, 
                    'choice_label' => 'nombre', 
                    'label' => 'Jugador Dueño',
                    'placeholder' => 'Selecciona un jugador...',
                ])
            ->end()

            ->with('Mecánicas de Juego', ['class' => 'col-md-6'])
                ->add('nivel', IntegerType::class, [
                    'label' => 'Nivel',
                    'empty_data' => '1'
                ])
                ->add('clase', EntityType::class, [
                    'class' => Clases::class,
                    'choice_label' => 'nombre',
                    'label' => 'Clase',
                    'placeholder' => 'Selecciona clase...',
                ])
                ->add('raza', EntityType::class, [
                    'class' => Razas::class,
                    'choice_label' => 'nombre',
                    'label' => 'Raza',
                    'placeholder' => 'Selecciona raza...',
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
            ->end()

            ->with('Imagen y Token', ['class' => 'col-md-6'])
                ->add('imagen', TextType::class, [
                    'label' => 'Ruta o URL de la Imagen', 
                    'required' => false
                ])
                ->add('token', TextType::class, [
                    'label' => 'Ruta o URL del Token', 
                    'required' => false
                ])
            ->end();
    }
}