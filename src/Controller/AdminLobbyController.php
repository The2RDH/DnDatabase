<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLobbyController extends AbstractController
{
    // Aquí definimos la URL '/admin/lobby' y su nombre interno 'app_admin_lobby'
    #[Route('/admin/lobby', name: 'app_admin_lobby')]
    public function index(): Response
    {
        return $this->render('admin_lobby/index.html.twig', [
            'controller_name' => 'Panel de Control del Master',
        ]);
    }
}