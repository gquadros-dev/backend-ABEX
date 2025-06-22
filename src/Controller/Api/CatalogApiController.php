<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CatalogoRepository; // Para buscar catálogos reais, se quiser

#[Route('/api/catalogs', name: 'api_catalogs_')]
class CatalogApiController extends AbstractController
{
    // Opcional: Injetar CatalogoRepository para buscar dados reais
    public function __construct(private ?CatalogoRepository $catalogoRepository = null) {}

    #[Route('', name: 'list', methods: ['GET'])]
    public function listCatalogs(): JsonResponse
    {
        // TODO: Implementar a lógica para buscar catálogos do banco de dados
        // Exemplo com dados reais: $catalogs = $this->catalogoRepository->findAll();
        $catalogs = [
            ['id' => 101, 'dataAtualizacao' => '2024-05-15T10:00:00Z'],
            ['id' => 102, 'dataAtualizacao' => '2024-06-01T14:30:00Z'],
        ];
        return $this->json($catalogs);
    }
}
