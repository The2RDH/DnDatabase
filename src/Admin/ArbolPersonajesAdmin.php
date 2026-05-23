<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use App\Entity\ArbolPersonajes;
use App\Entity\Personaje;

class ArbolPersonajesAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof ArbolPersonajes && $object->getId()
            ? 'Árbol de los ' . ($object->getApellido() ?? 'Sin Apellido')
            : 'Nuevo Árbol Genealógico';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', null, [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 60px;',
                'row_align' => 'center'
            ])
            ->add('personaje', null, [
                'label' => 'Personaje',
                'header_style' => 'width: 10%;',
                'associated_property' => 'nombre'
            ])
            ->addIdentifier('apellido', null, [
                'label' => 'Linaje / Apellido',
                'header_style' => 'width: 15%;'
            ])
            ->add('padre', null, [
                'label' => 'Padre',
                'header_style' => 'width: 10%;'
            ])
            ->add('madre', null, [
                'label' => 'Madre',
                'header_style' => 'width: 10%;'
            ])
            ->add('hermanos', null, [
                'label' => 'Hermanos',
                'header_style' => 'width: 15%;'
            ])
            ->add('hijos', null, [
                'label' => 'Hijos',
                'header_style' => 'width: 15%;'
            ])
            ->add('lugar_nacimiento', null, [
                'label' => 'Origen',
                'header_style' => 'width: 10%;'
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
            ->add('personaje', null, ['label' => 'Personaje'])
            ->add('apellido', null, ['label' => 'Apellido'])
            ->add('padre', null, ['label' => 'Padre'])
            ->add('madre', null, ['label' => 'Madre'])
            ->add('lugar_nacimiento', null, ['label' => 'Lugar de Nacimiento'])
            ->add('residencia', null, ['label' => 'Residencia']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos Arbol Genealógico', ['class' => 'col-md-6'])
                ->add('personaje', ModelAutocompleteType::class, [
                    'class' => Personaje::class,
                    'label' => 'Personaje Principal',
                    'property' => 'nombre',
                    'required' => false,
                    'placeholder' => 'Escribe el nombre del personaje...'
                ])
                ->add('apellido', TextType::class, [
                    'label' => 'Apellido / Nombre del clan / Dinastía',
                    'required' => false,
                    'attr' => ['maxlength' => 100]
                ])
                ->add('emblema', TextType::class, [
                    'label' => 'Emblema familiar',
                    'required' => false,
                    'attr' => ['maxlength' => 255]
                ])
                ->add('lugar_nacimiento', TextType::class, [
                    'label' => 'Lugar de Nacimiento',
                    'required' => false,
                    'attr' => ['maxlength' => 255]
                ])
                ->add('residencia', TextType::class, [
                    'label' => 'Hogar',
                    'required' => false,
                    'attr' => ['maxlength' => 255]
                ])
            ->end()

            ->with('Relaciones Familiares', ['class' => 'col-md-6'])
                ->add('padre', TextType::class, [
                    'label' => 'Nombre del Padre',
                    'required' => false,
                    'attr' => ['maxlength' => 100]
                ])
                ->add('madre', TextType::class, [
                    'label' => 'Nombre de la Madre',
                    'required' => false,
                    'attr' => ['maxlength' => 100]
                ])
                ->add('hermanos', TextType::class, [
                    'label' => 'Hermanos / Hermanas',
                    'required' => false,
                    'attr' => ['maxlength' => 100]
                ])
                ->add('hijos', TextType::class, [
                    'label' => 'Hijos / Hijas',
                    'required' => false,
                    'attr' => ['maxlength' => 100]
                ])
            ->end();
    }
}