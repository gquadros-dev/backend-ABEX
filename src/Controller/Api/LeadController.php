<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/leads', name: 'api_leads_')]
class LeadController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function listLeads(): JsonResponse
    {
        // TODO: Implementar a lógica para buscar leads do banco de dados
        $leads = [
            ['id' => 1, 'nome' => 'Novo Cliente A', 'email' => 'clienteA@email.com', 'status' => 'Interessado'],
            ['id' => 2, 'nome' => 'Cliente B', 'email' => 'clienteB@email.com', 'status' => 'Contato Realizado'],
        ];
        return $this->json($leads);
    }
}
