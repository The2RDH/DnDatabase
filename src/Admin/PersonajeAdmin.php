<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Personaje;

class PersonajeAdmin extends AbstractAdmin
{
    //Metodo para cabecera de CRUD
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
            ->add('_action', 'actions', [
                'label' => 'Acciones',
                'header_style' => 'text-align: center; width: 150px;',
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
                    'class' => \App\Entity\Alineamiento::class,
                    'choice_label' => 'nombre',
                    'label' => 'Alineamiento',
                    'placeholder' => 'Selecciona alineamiento...',
                    'required' => false
                ])
                ->add('jugador', EntityType::class, [
                    'class' => \App\Entity\Jugadores::class, 
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
                    'class' => \App\Entity\Clases::class,
                    'choice_label' => 'nombre',
                    'label' => 'Clase',
                    'placeholder' => 'Selecciona clase...',
                ])
                ->add('raza', EntityType::class, [
                    'class' => \App\Entity\Razas::class,
                    'choice_label' => 'nombre',
                    'label' => 'Raza',
                    'placeholder' => 'Selecciona raza...',
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