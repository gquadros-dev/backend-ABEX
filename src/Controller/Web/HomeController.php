<?php

// src/Controller/HomeController.php
namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    /**
     * Rota para a página inicial (Home Page).
     *
     * Acessível via GET na URL raiz (/).
     * O nome da rota 'app_home' é usado para gerar URLs programaticamente.
     *
     * @return Response A resposta HTTP contendo o HTML renderizado.
     */
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        // Renderiza o template Twig 'home/index.html.twig'.
        // Você pode passar um array de dados para o template como segundo argumento.
        // Por exemplo, 'nomeUsuario' => 'Visitante'.
        return $this->render('home/index.html.twig', [
            'titulo_pagina' => 'Home',
            'mensagem' => 'Explore nossa nova coleção de outono-inverno.',
        ]);
    }
}
