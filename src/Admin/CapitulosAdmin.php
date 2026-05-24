<?php

namespace App\Admin;

use App\Entity\Capitulos;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class CapitulosAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Capitulos && $object->getId()
            ? sprintf('Capítulo %d: %s', $object->getNumero(), $object->getTitulo())
            : 'Nuevo Capítulo';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px',
                'row_align' => 'center'
            ])
            ->add('numero', null, [
                'label' => 'Nº',
                'header_style' => 'text-align: center; width: 70px',
                'row_align' => 'center'
            ])
            ->add('titulo', null, [
                'label' => 'Título del Capítulo',
                'header_style' => 'width: 30%;'
            ])
            ->add('resumen', null, [
                'label' => 'Resumen',
                'header_style' => 'width: 45%;'
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
            ->add('numero', null, ['label' => 'Número de Capítulo'])
            ->add('titulo', null, ['label' => 'Título']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Datos del Capítulo', ['class' => 'col-md-6'])
                ->add('numero', IntegerType::class, [
                    'label' => 'Número de Capítulo',
                    'attr' => ['min' => 1]
                ])
                ->add('titulo', TextType::class, [
                    'label' => 'Título',
                    'attr' => ['maxlength' => 50]
                ])
                ->add('resumen', TextareaType::class, [
                    'label' => 'Resumen / Sinopsis corta',
                    'required' => false,
                    'attr' => ['rows' => 3, 'maxlength' => 255, 'placeholder' => 'Breve resumen de los acontecimientos clave del capítulo...']
                ])
            ->end()

            ->with('Contenido de la Historia', ['class' => 'col-md-12'])
                ->add('historia', TextareaType::class, [
                    'label' => 'Texto Completo del Capítulo',
                    'required' => false,
                    'attr' => ['rows' => 25, 'placeholder' => 'Escribe aquí el desarrollo completo de la historia...']
                ])
            ->end();
    }
}