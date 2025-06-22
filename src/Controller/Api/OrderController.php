<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/pedidos', name: 'api_orders_')]
class OrderController extends AbstractController
{
    #[Route('/separacao', name: 'separation_list', methods: ['GET'])]
    public function listOrdersForSeparation(): JsonResponse
    {
        // TODO: Implementar a lógica para buscar pedidos com status "pendente_separacao"
        $orders = [
            ['id' => 201, 'clienteNome' => 'Ana Paula', 'status' => 'Aguardando Separação'],
            ['id' => 202, 'clienteNome' => 'João Victor', 'status' => 'Aguardando Separação'],
        ];
        return $this->json($orders);
    }
}
