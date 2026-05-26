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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Jefes;
use App\Entity\Razas;
use App\Entity\Clases;
use App\Entity\Estado;
use App\Entity\Estadisticas;
use App\Entity\Especializacion;
use App\Entity\Alineamiento;
use App\Entity\Jugadores;
use App\Entity\Personaje;

class JefesAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Jefes && $object->getId()
            ? $object->getNombre()
            : 'Nuevo Jefe de Élite';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('nombre', null, [
                'label' => 'Nombre',
                'header_style' => 'width: 25%; font-weight: bold;'
            ])
            ->add('nivel', null, [
                'label' => 'Nivel',
                'header_style' => 'text-align: center; width: 5%;',
                'row_align' => 'center'
            ])
            ->add('raza', null, [
                'label' => 'Raza',
                'header_style' => 'width: 13%;',
                'associated_property' => 'nombre'
            ])
            ->add('clase', null, [
                'label' => 'Clase',
                'header_style' => 'width: 13%;',
                'associated_property' => 'nombre'
            ])
            ->add('estado', null, [
                'label' => 'Estado Vital',
                'header_style' => 'width: 7%;', 
                'associated_property' => 'nombre'
            ])
            ->add('descubierto', 'boolean', [
                'label' => 'Avistado',
                'header_style' => 'text-align: center; width: 10%;', 
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('derrotado', 'boolean', [
                'label' => 'Derrotado',
                'header_style' => 'text-align: center; width: 10%;', 
                'row_align' => 'center',
                'editable' => true
            ])
            ->add('_action', 'actions', [
                'label' => 'Acciones',
                'header_style' => 'text-align: center; width: 12%;',
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombre')
            ->add('nivel')
            ->add('raza')
            ->add('clase')
            ->add('estado')
            ->add('derrotado')
            ->add('analizado')
            ->add('descubierto');
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Perfil del Jefe', ['class' => 'col-md-7'])
                ->add('nombre', TextType::class, [
                    'label' => 'Nombre del Jefe',
                    'attr' => ['maxlength' => 30]
                ])
                ->add('nivel', IntegerType::class, [
                    'label' => 'Nivel de Desafío'
                ])
                ->add('raza', EntityType::class, [
                    'class' => Razas::class,
                    'label' => 'Raza',
                    'placeholder' => 'Selecciona raza...',
                    'required' => false
                ])
                ->add('clase', EntityType::class, [
                    'class' => Clases::class,
                    'label' => 'Clase',
                    'placeholder' => 'Selecciona clase...',
                    'required' => false
                ])
                ->add('especializacion', EntityType::class, [
                    'class' => Especializacion::class,
                    'label' => 'Especialización',
                    'placeholder' => 'Selecciona especialización...',
                    'required' => false
                ])
                ->add('imagen', TextType::class, [
                    'label' => 'Ruta de la Imagen',
                    'required' => false,
                    'attr' => ['placeholder' => 'media/images/default.jpg'] 
                ])
                ->add('token', TextType::class, [
                    'label' => 'Ruta del Token',
                    'required' => false,
                    'attr' => ['placeholder' => 'media/tokens/default.png'] 
                ])
            ->end()

            ->with('Estado y Campaña', ['class' => 'col-md-5'])
                ->add('estado', EntityType::class, [
                    'class' => Estado::class,
                    'label' => 'Estado Vital',
                    'placeholder' => 'Selecciona el estado...', 
                    'required' => false
                ])
                ->add('descubierto', CheckboxType::class, [
                    'label' => '¿Registrado en el códice?',
                    'required' => false,
                    'help' => 'Determina si el jefe se mostrará a los jugadores'
                ])
                ->add('derrotado', CheckboxType::class, [
                    'label' => '¿Ha sido derrotado?',
                    'required' => false
                ])
                ->add('analizado', CheckboxType::class, [
                    'label' => '¿Ha sido analizado?',
                    'required' => false,
                    'help' => 'Determina si los jugadores conocen los detalles del jefe (Debilidades, Fortalezas y Estadísticas)'
                ])
                ->add('estadisticas', EntityType::class, [
                    'class' => Estadisticas::class,
                    'label' => 'Hoja de Estadísticas (ID)',
                    'placeholder' => 'Asignar valores numéricos...',
                    'required' => false,
                    'attr' => ['class' => 'select2'], 
                    'choice_label' => function (Estadisticas $est) {
                        return sprintf(
                            'ID: %d — [FUE: %d | DES: %d | CON: %d | INT: %d]',
                            $est->getId(), $est->getFuerza(), $est->getDestreza(), $est->getConstitucion(), $est->getIntelecto()
                        );
                    },
                ])
                ->add('fortalezas', TextareaType::class, [
                    'label' => 'Fortalezas',
                    'required' => false,
                    'attr' => ['rows' => 2, 'placeholder' => 'Inmunidades, resistencias...']
                ])
                ->add('debilidades', TextareaType::class, [
                    'label' => 'Debilidades',
                    'required' => false,
                    'attr' => ['rows' => 2, 'placeholder' => 'Vulnerabilidades...']
                ])
                ->add('golpeGracia', EntityType::class, [
                    'class' => Personaje::class,
                    'label' => 'Golpe de gracia',
                    'placeholder' => 'Selecciona quién acabó con el jefe...', 
                    'required' => false
                ])
            ->end()

            ->with('Descripción y Lore', ['class' => 'col-md-12'])
                ->add('alineamiento', EntityType::class, [
                    'class' => Alineamiento::class,
                    'label' => 'Alineamiento',
                    'placeholder' => 'Selecciona tendencia moral...',
                    'required' => false
                ])
                ->add('edad', TextType::class, ['label' => 'Edad', 'required' => false, 'attr' => ['class' => 'col-md-4']])
                ->add('altura', TextType::class, ['label' => 'Altura', 'required' => false, 'attr' => ['class' => 'col-md-4']])
                ->add('peso', TextType::class, ['label' => 'Peso', 'required' => false, 'attr' => ['class' => 'col-md-4']])
                ->add('descripcion', TextareaType::class, [
                    'label' => 'Descripción',
                    'required' => false,
                    'attr' => ['rows' => 3]
                ])
                ->add('lore', TextareaType::class, [
                    'label' => 'Historia y Trasfondo',
                    'required' => false,
                    'attr' => ['rows' => 6]
                ])
            ->end();
    }
}