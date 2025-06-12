<?php
namespace App\Controller\Api;

use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

class ClienteController extends AbstractController
{
    /**
     * Construtor do controller.
     * Injeta o ClienteRepository para permitir a interação com a entidade Produto.
     *
     * @param ClienteRepository $clienteRepository O repositório da entidade Produto.
     */
    public function __construct(
        private ClienteRepository $clienteRepository
    ) {
    }

    /**
     * Rota para buscar clientes paginados.
     * Acessível via GET em /api/clientes.
     * Aceita os parâmetros de query 'offset' e 'limit'.
     *
     * @param int $offset O deslocamento inicial (quantos registros pular). Padrão é 0.
     * @param int $limit O número máximo de registros a retornar. Padrão é 30.
     * @return JsonResponse Uma resposta JSON contendo a lista de clientes.
     */
    #[Route('/api/clientes', name: 'app_clientes_paginated', methods: ['GET'])]
    public function getClientesPaginated(
        // Mapeia o parâmetro de query 'offset' para a variável $offset.
        // Se não for fornecido, usa o valor padrão 0.
        #[MapQueryParameter] int $offset = 0,
        // Mapeia o parâmetro de query 'limit' para a variável $limit.
        // Se não for fornecido, usa o valor padrão 30.
        #[MapQueryParameter] int $limit = 30
    ): JsonResponse {
        // Validação básica para garantir que offset e limit são valores positivos.
        if ($offset < 0) {
            $offset = 0;
        }
        if ($limit < 1) {
            $limit = 30;
        }

        $clientes = $this->clienteRepository->findBy([], ['id' => 'ASC'], $limit, $offset);

        // Retorna a lista de clientes como uma resposta JSON.
        // Usamos o segundo argumento do método json() para passar um contexto de serialização.
        // O 'clientes' => ['cliente:read'] instrui o serializador a incluir apenas
        // as propriedades marcadas com #[Groups(['cliente:read'])] na entidade Cliente.
        return $this->json($clientes, 200, [], ['groups' => ['cliente:read']]);
    }
}
