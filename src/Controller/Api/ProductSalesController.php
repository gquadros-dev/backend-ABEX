<?php
namespace App\Controller\Api;

use App\Repository\ProdutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

#[Route('/api/product-sales', name: 'api_product_sales_')]
class ProductSalesController extends AbstractController
{
    /**
     * Construtor para injetar o ProdutoRepository.
     * @param ProdutoRepository $produtoRepository
     */
    public function __construct(private ProdutoRepository $produtoRepository)
    {
    }

    /**
     * Retorna a quantidade de vendas por produto nos últimos dias.
     *
     * Exemplo de uso: /api/product-sales?days=7
     *
     * @param int $days O número de dias para considerar nas vendas. Padrão: 7.
     * @return JsonResponse Um array associativo com produto_id => total_vendido.
     */
    #[Route('', name: 'summary', methods: ['GET'])]
    public function getSalesSummary(
        #[MapQueryParameter(name: 'days')] int $days = 7
    ): JsonResponse {
        // Validação básica
        if ($days < 1) {
            $days = 7;
        }

        $salesData = $this->produtoRepository->getSalesQuantityLastDays($days);

        // Retorna os dados de vendas como JSON
        return $this->json($salesData);
    }
}
