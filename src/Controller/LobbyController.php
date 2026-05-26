<?php

namespace App\Controller;

use App\Entity\Personaje;
use App\Entity\Npc;
use App\Entity\Enemigos;
use App\Entity\Jefes;
use App\Repository\PersonajeRepository;
use App\Repository\AlineamientoRepository;
use App\Repository\RazasRepository;
use App\Repository\ClasesRepository;
use App\Repository\EspecializacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LobbyController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) 
    {
        $this->em = $em;
    }

    #[Route('/', name: 'app_home')]
    public function redirect8000(): RedirectResponse
    {
        return $this->redirectToRoute('app_login');
    }

    #[Route('/admin/lobby', name: 'app_lobby_master')]
    public function indexAdmin(): Response
    {
        return $this->render('admin_lobby/index.html.twig', [
            'controller_name' => 'Lobby de Jugadores',
        ]);
    }

    #[Route('/lobby', name: 'app_lobby')]
    public function lobby(): Response
    {
        /** @var \App\Entity\User|null $usuario */
        $usuario = $this->getUser();
        if (!$usuario) {
            return $this->redirectToRoute('app_login');
        }
        $jugador = $usuario->getJugadores(); 
        $personajes = [];
        if ($jugador) {
            $personajes = $jugador->getPersonajes();
        }
        return $this->render('lobby/index.html.twig', [
            'personajes' => $personajes,
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

    //RUTA: Tiendas
    #[Route('/lobby/tiendas', name: 'app_lobby_tiendas')]
    public function tiendas(EntityManagerInterface $em): Response
    {
        $comerciantes = $em->getRepository(Npc::class)->findBy(
            [
                'comerciante' => true,
                'descubierto' => true
            ],
            ['nombre' => 'ASC']
        );

        return $this->render('lobby/tiendas/listado.html.twig', [
            'comerciantes' => $comerciantes,
            'subseccion' => 'tiendas'
        ]);
    }

    //RUTA: Tienda detallada
    #[Route('/lobby/tiendas/{id}', name: 'app_lobby_tiendas_detalle')]
    public function tiendaDetalle(int $id, EntityManagerInterface $em): Response
    {
        $comerciante = $em->getRepository(Npc::class)->findOneBy([
            'id' => $id,
            'comerciante' => true,
            'descubierto' => true
        ]);

        if (!$comerciante) {
            throw $this->createNotFoundException('Este comerciante no está disponible o aún no ha sido descubierto.');
        }

        return $this->render('lobby/tiendas/detalle.html.twig', [
            'comerciante' => $comerciante,
            'subseccion' => 'tiendas'
        ]);
    }

    //RUTA: Enemigos (2VISTAS)
    #[Route('/lobby/bestiario', name: 'app_lobby_bestiario')]
    public function bestiario(EntityManagerInterface $em): Response
    {
        // Buscamos todos los enemigos descubiertos ordenados por nombre
        $enemigos = $em->getRepository(Enemigos::class)->findBy(
            ['descubierto' => true],
            ['nombre' => 'ASC']
        );

        $porTipos = [];
        $porGrupos = [];

        foreach ($enemigos as $enemigo) {
            // VISTA 1: AGRUPACIÓN POR TIPOS 
            $tiposColeccion = $enemigo->getTipo();
            if ($tiposColeccion->isEmpty()) {
                $porTipos['Otros peligros'][] = $enemigo;
            } else {
                foreach ($tiposColeccion as $tipoEnemigo) {
                    $nombreTipo = $tipoEnemigo->getNombre() ?? 'Desconocido';
                    $porTipos[$nombreTipo][] = $enemigo;
                }
            }

            // VISTA 2: AGRUPACIÓN POR GRUPOS
            $gruposColeccion = $enemigo->getGrupo();
            if ($gruposColeccion->isEmpty()) {
                $porGrupos['Sin facción conocida'][] = $enemigo;
            } else {
                foreach ($gruposColeccion as $grupoEnemigo) {
                    $nombreGrupo = $grupoEnemigo->getNombre() ?? 'Desconocido';
                    $porGrupos[$nombreGrupo][] = $enemigo;
                }
            }
        }

        // Ordenamos alfabéticamente las llaves de ambos bloques
        ksort($porTipos);
        ksort($porGrupos);

        return $this->render('lobby/enemigos/listado.html.twig', [
            'porTipos' => $porTipos,
            'porGrupos' => $porGrupos,
            'subseccion' => 'enemigos'
        ]);
    }

    //RUTA: Detalle enemigos
    #[Route('/lobby/bestiario/{id}', name: 'app_lobby_enemigo_detalle')]
    public function enemigoDetalle(int $id, EntityManagerInterface $em): Response
    {
        $enemigo = $em->getRepository(Enemigos::class)->findOneBy([
            'id' => $id,
            'descubierto' => true
        ]);

        if (!$enemigo) {
            throw $this->createNotFoundException('Esta criatura no está registrada en el bestiario o aún es desconocida.');
        }

        return $this->render('lobby/enemigos/detalle.html.twig', [
            'enemigo' => $enemigo,
            'subseccion' => 'enemigos'
        ]);
    }

    //RUTA: Lista Jefes
    #[Route('/lobby/jefes', name: 'app_lobby_jefes')]
    public function listadoJefes(): Response
    {
        $jefes = $this->em->getRepository(Jefes::class)->findBy(
            ['descubierto' => true],
            ['nivel' => 'DESC', 'nombre' => 'ASC'] // Ordenados por nivel de amenaza primero
        );

        return $this->render('lobby/jefes/listado.html.twig', [
            'jefes' => $jefes,
            'subseccion' => 'jefes'
        ]);
    }
    
    // RUTA: Detalle de un Jefe concreto
    #[Route('/lobby/jefe/{id}', name: 'app_lobby_jefe_detalle')]
    public function detalleJefe(int $id): Response
    {
        $jefe = $this->em->getRepository(Jefes::class)->findOneBy([
            'id' => $id,
            'descubierto' => true
        ]);

        if (!$jefe) {
            throw $this->createNotFoundException('Este objetivo de élite no está registrado o aún no ha sido avistado en la campaña.');
        }

        return $this->render('lobby/jefes/detalle.html.twig', [
            'jefe' => $jefe,
            'subseccion' => 'jefes'
        ]);
    }

    //RUTA: Otras características
    #[Route('/lobby/caracteristicas', name: 'app_lobby_otrasCaracteristicas')]
    public function caracteristicasIndex(): Response
    {
        return $this->render('lobby/otrosDatos/listado.html.twig', [
            'subseccion' => 'otras_caracteristicas'
        ]);
    }

    //RUTA: Alineamientos
    #[Route('/lobby/caracteristicas/alineamientos', name: 'app_lobby_alineamientos')]
    public function alineamientosList(AlineamientoRepository $alineamientoRepository): Response
    {
        return $this->render('lobby/otrosDatos/alineamientos.html.twig', [
            'alineamientos' => $alineamientoRepository->findAll(),
            'subseccion' => 'otras_caracteristicas'
        ]);
    }

    //RUTA: Razas
    #[Route('/lobby/caracteristicas/razas', name: 'app_lobby_razas')]
    public function razasList(RazasRepository $razasRepository): Response
    {
        return $this->render('lobby/otrosDatos/razas.html.twig', [
            'razas' => $razasRepository->findAllOrderedByOrigen(),
            'subseccion' => 'otras_caracteristicas'
        ]);
    }

    //RUTA: Clases y Especializaciones
    #[Route('/lobby/caracteristicas/clases', name: 'app_lobby_clases')]
    public function clasesList(ClasesRepository $clasesRepository): Response
    {
        return $this->render('lobby/otrosDatos/clases.html.twig', [
            'clases' => $clasesRepository->findBy([], ['nombre' => 'ASC']),
            'subseccion' => 'otras_caracteristicas'
        ]);
    }

}