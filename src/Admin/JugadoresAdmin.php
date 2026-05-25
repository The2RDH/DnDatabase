<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Jugadores;
use App\Entity\Usuarios;

class JugadoresAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Jugadores && $object->getId()
            ? $object->getNick()
            : 'Nuevo Jugador';
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
                'label' => 'Nombre',
                'header_style' => 'width: 20%;'
            ])
            ->add('nick', null, [
                'label' => 'Nick / Alias',
                'header_style' => 'width: 20%;'
            ])
            ->add('localizacion', null, [
                'label' => 'Localización',
                'header_style' => 'width: 20%;'
            ])
            ->add('especialidad', null, [
                'label' => 'Especialidad',
                'header_style' => 'width: 20%;'
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
            ->add('nick', null, ['label' => 'Nick'])
            ->add('localizacion', null, ['label' => 'Localización'])
            ->add('especialidad', null, ['label' => 'Especialidad']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos Personales', ['class' => 'col-md-6'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre Completo'
                ])
                ->add('localizacion', TextType::class, [
                    'label' => 'Ciudad / Región',
                    'required' => false
                ])
            ->end()
            
            ->with('Datos de Juego', ['class' => 'col-md-6'])
                ->add('nick', TextType::class, [
                    'label' => 'Nick (Nombre de usuario/Comunidad)'
                ])
                ->add('especialidad', TextType::class, [
                    'label' => 'Especialidad (Ej: DM, Diseñador, Tanque)',
                    'required' => false
                ])
                ->add('usuario', EntityType::class, [ 
                    'class' => Usuarios::class,
                    'choice_label' => 'nombreUsuario', 
                    'label' => 'Cuenta de Usuario Vinculada',
                    'placeholder' => 'Selecciona la cuenta de inicio de sesión...',
                    'required' => false, 
                ])
            ->end();
    }
}