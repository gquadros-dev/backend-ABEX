<?php
namespace App\Controller\Api;

use App\Repository\ProdutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

class ProdutoController extends AbstractController
{
    /**
     * Construtor do controller.
     * Injeta o ProdutoRepository para permitir a interação com a entidade Produto.
     *
     * @param ProdutoRepository $produtoRepository O repositório da entidade Produto.
     */
    public function __construct(
        private ProdutoRepository $produtoRepository
    ) {
    }

    /**
     * Rota para buscar produtos paginados.
     * Acessível via GET em /api/produtos.
     * Aceita os parâmetros de query 'offset' e 'limit'.
     *
     * @param int $offset O deslocamento inicial (quantos registros pular). Padrão é 0.
     * @param int $limit O número máximo de registros a retornar. Padrão é 30.
     * @return JsonResponse Uma resposta JSON contendo a lista de produtos.
     */
    #[Route('/api/produtos', name: 'app_produtos_paginated', methods: ['GET'])]
    public function getProdutosPaginated(
        // Mapeia o parâmetro de query 'offset' para a variável $offset.
        // Se não for fornecido, usa o valor padrão 0.
        #[MapQueryParameter] int $offset = 0,
        // Mapeia o parâmetro de query 'limit' para a variável $limit.
        // Se não for fornecido, usa o valor padrão 30.
        #[MapQueryParameter] int $limit = 100
    ): JsonResponse {
        // Validação básica para garantir que offset e limit são valores positivos.
        if ($offset < 0) {
            $offset = 0;
        }
        if ($limit < 1) {
            $limit = 100;
        }

        $produtos = $this->produtoRepository->findBy([], ['id' => 'ASC'], $limit, $offset);

        // Retorna a lista de produtos como uma resposta JSON.
        // Usamos o segundo argumento do método json() para passar um contexto de serialização.
        // O 'groups' => ['produto:read'] instrui o serializador a incluir apenas
        // as propriedades marcadas com #[Groups(['produto:read'])] na entidade Produto.
        return $this->json($produtos, 200, [], ['groups' => ['produto:read']]);
    }
}
