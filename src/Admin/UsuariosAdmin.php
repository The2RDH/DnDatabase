<?php

namespace App\Admin;

use App\Entity\Usuarios;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsuariosAdmin extends AbstractAdmin
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    //Metodo para cabecera de CRUD
    public function toString(object $object): string
    {
        return $object instanceof Usuarios && $object->getId()
            ? $object->getNombreUsuario()
            : 'Nuevo Usuario';
    }

    // Qué columnas se ven en la lista general de usuarios
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id', 'integer', [
                'label' => 'ID',
                'row_align' => 'center',
                'header_style' => 'width: 5%; text-align: center;'
            ])
            ->add('nombreUsuario', null, [
                'label' => 'Nombre de Usuario',
                'row_align' => 'center',
                'header_style' => 'width: 50%; text-align: center'
            ])
            ->add('roles', 'choice', [
                'label' => 'Roles Asignados',
                'multiple' => true,
                'row_align' => 'center',
                'header_style' => 'text-align: center; width: 30%;',
                'choices' => [
                    'ROLE_MASTER' => 'Master',
                    'ROLE_ADMIN'  => 'Administrador',
                    'ROLE_USER'   => 'Jugador Estándar',
                ],
            ])
            // Acciones: Centramos los botones de editar/borrar al final
            ->add('_action', 'actions', [
                'label' => 'Acciones',
                'row_align' => 'center',
                'header_style' => 'text-align: center; width: 15%;',
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    // Qué campos aparecen en los filtros de búsqueda
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('nombreUsuario', null, ['label' => 'Buscar por Nombre']);
    }

    // Qué campos aparecen al Crear o Editar un usuario
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('nombreUsuario', TextType::class, [
                'label' => 'Nombre de Usuario'
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Roles',
                'choices' => [
                    'Master' => 'ROLE_MASTER',
                    'Administrador' => 'ROLE_ADMIN',
                    'Jugador Estándar' => 'ROLE_USER',
                ],
                'multiple' => true, // Al ser un array JSON en la BDD
                'expanded' => true, // Los muestra como Checkboxes individuales
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'required' => $this->isCurrentRoute('create'),
                'empty_data' => '',
            ]);
    }
    protected function prePersist(object $usuario): void
    {
        $this->hashPassword($usuario);
    }

    protected function preUpdate(object $usuario): void
    {
        $this->hashPassword($usuario);
    }

    private function hashPassword(object $usuario): void
    {
        if ($usuario->getPassword()) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $usuario,
                $usuario->getPassword()
            );
            $usuario->setPassword($hashedPassword);
        }
    }
}