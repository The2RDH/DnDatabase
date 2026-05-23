<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Estadisticas;
use App\Entity\Recursos;

class EstadisticasAdmin extends AbstractAdmin
{
    public function toString(object $object): string
    {
        return $object instanceof Estadisticas && $object->getId()
            ? sprintf('Estadísticas ID #%d (Fza: %d, Des: %d, Int: %d, Con: %d, Sab: %d, Car: %d)', 
            $object->getId(), $object->getFuerza(), $object->getDestreza(), $object->getIntelecto(), $object->getConstitucion(), $object->getSabiduria(), $object->getCarisma())
            : 'Nuevas Estadísticas';
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', null, [
                'label' => 'ID',
                'header_style' => 'text-align: center; width: 80px;',
                'row_align' => 'center'
            ])
            ->add('fuerza', null, [
                'label' => 'FUE',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('destreza', null, [
                'label' => 'DES',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('intelecto', null, [
                'label' => 'INT',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('constitucion', null, [
                'label' => 'CON',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('sabiduria', null, [
                'label' => 'SAB',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('carisma', null, [
                'label' => 'CAR',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('vida', null, [
                'label' => 'HP',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('recurso', null, [
                'label' => 'Recurso',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
            ])
            ->add('iniciativa', null, [
                'label' => 'Iniciativa',
                'header_style' => 'text-align: center; width: 8%;',
                'row_align' => 'center'
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
            ->add('id', null, ['label' => 'ID de Estadísticas'])
            ->add('fuerza', null, ['label' => 'Fuerza'])
            ->add('destreza', null, ['label' => 'Destreza'])
            ->add('intelecto', null, ['label' => 'Intelecto'])
            ->add('vida', null, ['label' => 'Vida mínima']);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Características principales', ['class' => 'col-md-3'])
                ->add('vida', IntegerType::class, ['label' => 'Puntos de Vida', 'required' => false])
                ->add('recurso', EntityType::class, [
                    'class' => Recursos::class,
                    'choice_label' => 'nombre',
                    'label' => 'Tipo recurso',
                    'placeholder' => 'Selecciona recurso principal...',
                    'required' => false,
                ]) 
                ->add('cantidad_recurso', IntegerType::class, ['label' => 'Cantidad de Recurso', 'required' => false])
                ->add('recurso_secundario', EntityType::class, [
                    'class' => Recursos::class,
                    'choice_label' => 'nombre', 
                    'label' => 'Recurso Secundario',
                    'placeholder' => 'Selecciona recurso secundario...',
                    'required' => false,
                ])
                ->add('cantidad_recurso_secundario', IntegerType::class, ['label' => 'Cantidad Recurso Secundario', 'required' => false])
                ->add('armadura', IntegerType::class, ['label' => 'Clase de Armadura', 'required' => false])
                ->add('movimiento', IntegerType::class, ['label' => 'Movimiento / Velocidad', 'required' => false])
                ->add('iniciativa', IntegerType::class, ['label' => 'Bono de Iniciativa', 'required' => false])
                ->add('competencia', IntegerType::class, ['label' => 'Bono de Competencia', 'required' => false])
            ->end()

            ->with('Atributos Principales', ['class' => 'col-md-3'])
                ->add('fuerza', IntegerType::class, ['label' => 'Fuerza (FUE)', 'required' => false])
                ->add('destreza', IntegerType::class, ['label' => 'Destreza (DES)', 'required' => false])
                ->add('intelecto', IntegerType::class, ['label' => 'Intelecto (INT)', 'required' => false])
                ->add('constitucion', IntegerType::class, ['label' => 'Constitución (CON)', 'required' => false])
                ->add('sabiduria', IntegerType::class, ['label' => 'Sabiduría (SAB)', 'required' => false])
                ->add('carisma', IntegerType::class, ['label' => 'Carisma (CAR)', 'required' => false])
            ->end()

            ->with('Atributos Secundarios', ['class' => 'col-md-2'])
                ->add('acrobacias', IntegerType::class, ['label' => 'Acrobacias', 'required' => false])
                ->add('animalismo', IntegerType::class, ['label' => 'Animalismo', 'required' => false])
                ->add('atletismo', IntegerType::class, ['label' => 'Atletismo', 'property_path' => 'atletismo', 'required' => false])
                ->add('caos', IntegerType::class, ['label' => 'Caos', 'required' => false])
                ->add('conocimiento_magico', IntegerType::class, ['label' => 'Conocimiento Mágico', 'property_path' => 'conocimiento_magico', 'required' => false])
                ->add('enganio', IntegerType::class, ['label' => 'Engaño', 'required' => false])
                ->add('historia', IntegerType::class, ['label' => 'Historia', 'required' => false])
            ->end()
            ->with('Atributos Secundarios II', ['class' => 'col-md-2'])
                ->add('interpretacion', IntegerType::class, ['label' => 'Interpretación', 'required' => false])
                ->add('intimidacion', IntegerType::class, ['label' => 'Intimidación', 'required' => false])
                ->add('investigacion', IntegerType::class, ['label' => 'Investigación', 'required' => false])
                ->add('juego_manos', IntegerType::class, ['label' => 'Juego de Manos', 'required' => false])
                ->add('medicina', IntegerType::class, ['label' => 'Medicina', 'required' => false])
                ->add('naturaleza', IntegerType::class, ['label' => 'Naturaleza', 'required' => false])
                ->add('orden', IntegerType::class, ['label' => 'Orden', 'required' => false])
            ->end()
            ->with('Atributos Secundarios III', ['class' => 'col-md-2'])
                ->add('percepcion', IntegerType::class, ['label' => 'Percepción', 'required' => false])
                ->add('perspicacia', IntegerType::class, ['label' => 'Perspicacia', 'required' => false])
                ->add('persuasion', IntegerType::class, ['label' => 'Persuasión', 'required' => false])
                ->add('religion', IntegerType::class, ['label' => 'Religión', 'required' => false])
                ->add('sigilo', IntegerType::class, ['label' => 'Sigilo', 'required' => false])
                ->add('supervivencia', IntegerType::class, ['label' => 'Supervivencia', 'required' => false])
            ->end();
    }
}