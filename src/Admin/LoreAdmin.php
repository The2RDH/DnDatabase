<?php

namespace App\Admin;

use App\Entity\Lore;
use App\Entity\Personaje; 
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class LoreAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Lore && $object->getId()
            ? $object->getTitulo()
            : 'Nuevo Fragmento de Lore';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->add('titulo', null, [
                'label' => 'Título del Lore',
                'header_style' => 'width: 45%;'
            ])
            ->add('personaje', null, [
                'label' => 'Personajes Vinculados',
                'header_style' => 'width: 40%;'
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
            ->add('titulo', null, ['label' => 'Título'])
            ->add('personaje', null, ['label' => 'Personaje Vinculado']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Metadatos e Identidad', ['class' => 'col-md-12'])
                ->add('titulo', TextType::class, [
                    'label' => 'Título',
                    'attr' => ['maxlength' => 100,]
                ])
                ->add('personaje', ModelType::class, [
                    'class' => Personaje::class,
                    'property' => 'nombre',
                    'label' => 'Personajes Relacionados',
                    'placeholder' => 'Selecciona uno o más personajes...',
                    'multiple' => true,
                    'required' => false,
                    'by_reference' => false,
                    'btn_add' => false
                ])
                ->add('texto', TextareaType::class, [
                    'label' => 'Relato completo',
                    'required' => false,
                    'attr' => ['rows' => 25]
                ])
            ->end();
    }
}