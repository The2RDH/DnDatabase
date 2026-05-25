<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Entity\Npc;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LobbyController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
    }

    #[Route('/lobby', name: 'app_lobby')]
    public function index(): Response
    {
        return $this->render('lobby/index.html.twig', [
            'controller_name' => 'Lobby de Jugadores',
        ]);
    }

    // RUTA: Listado de Personajes
    #[Route('/lobby/personajes', name: 'app_lobby_personajes')]
    public function listadoPersonajes(): Response
    {
        $personajes = $this->em->getRepository(Personaje::class)->findAll();

        return $this->render('lobby/personajes/listado.html.twig', [
            'personajes' => $personajes,
            'subseccion' => 'personajes'
        ]);
    }

    // RUTA: Detalle de un Personaje concreto
    #[Route('/lobby/personaje/{id}', name: 'app_lobby_personaje_detalle')]
    public function detallePersonaje(int $id): Response
    {
        $personaje = $this->em->getRepository(Personaje::class)->find($id);

        if (!$personaje) {
            throw $this->createNotFoundException('El personaje no existe.');
        }

        return $this->render('lobby/personajes/detalle.html.twig', [
            'personaje' => $personaje,
            'subseccion' => 'personajes'
        ]);
    }

    // RUTA: Mi Personaje
    #[Route('/lobby/mi-personaje', name: 'app_lobby_mi_personaje')]
    public function miPersonaje(): Response
    {
        /** @var \App\Entity\User|null $usuario */
        $usuario = $this->getUser();
        if (!$usuario) {
            return $this->redirectToRoute('app_login');
        }
        $jugador = $usuario->getJugadores(); 

        if (!$jugador) {
            throw $this->createNotFoundException('Tu cuenta de usuario no tiene una ficha de Jugador vinculada en el backend.');
        }
        $personaje = $jugador->getPersonajes()->first(); 

        if (!$personaje) {
            return $this->render('lobby/personajes/sin_personaje.html.twig', [
                'subseccion' => 'mi_personaje'
            ]);
        }
        
        return $this->render('lobby/personajes/mi_personaje.html.twig', [
            'personaje' => $personaje,
            'subseccion' => 'mi_personaje'
        ]);
    }

    //RUTA: Npcs
    #[Route('/lobby/npcs', name: 'app_lobby_npcs')]
    public function listadoNpcs(EntityManagerInterface $em): Response
    {
        // Filtro estricto: Solo cargamos los NPCs cuyo estado de descubrimiento sea true
        $npcs = $em->getRepository(Npc::class)->findBy(['descubierto' => true]);
    
        return $this->render('lobby/npcs/listado.html.twig', [
            'npcs' => $npcs,
            'subseccion' => 'npcs'
        ]);
    }

    //RUTA: Npc Detallado
    #[Route('/lobby/npc/{id}', name: 'app_lobby_npc_detalle')]
    public function detalleNpc(Npc $npc): Response
    {
        // Doble escudo de seguridad: Si alguien intenta forzar la URL de un NPC oculto
        if (!$npc->isDescubierto()) {
            throw $this->createNotFoundException('Este personaje no ha sido descubierto por los jugadores todavía.');
        }
        return $this->render('lobby/npcs/detalle.html.twig', [
            'npc' => $npc,
            'subseccion' => 'npcs'
        ]);
    }
}