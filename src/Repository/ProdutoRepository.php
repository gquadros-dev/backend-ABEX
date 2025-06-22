<?php
namespace App\Repository;

use App\Entity\Produto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping; // Importe esta classe

/**
 * @extends ServiceEntityRepository<Produto>
 *
 * @method Produto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produto[]    findAll()
 * @method Produto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produto::class);
    }

    /**
     * Busca a quantidade total vendida de cada produto nos últimos N dias.
     *
     * @param int $days O número de dias para considerar (padrão: 7).
     * @return array Um array associativo onde a chave é o ID do produto e o valor é a quantidade vendida.
     * Ex: [1 => 10, 2 => 5, ...]
     */
    public function getSalesQuantityLastDays(int $days = 7): array
    {
        // Cria um objeto DateTime para a data de N dias atrás
        $dateLimit = new \DateTimeImmutable("$days days ago");

        // Usamos DQL (Doctrine Query Language) para fazer o JOIN e a agregação.
        // DQL é a forma preferida de fazer queries complexas com Doctrine.
        $results = $this->getEntityManager()->createQueryBuilder()
            ->select('IDENTITY(pp.produto) AS produto_id', 'SUM(pp.quantidade) AS total_vendido')
            ->from('App\Entity\PedidoProduto', 'pp')
            ->join('pp.pedido', 'p') // pp.pedido refere-se à propriedade 'pedido' na entidade PedidoProduto
            ->where('p.dataPedido >= :dateLimit') // Filtra pedidos a partir da data limite
            ->groupBy('produto_id') // Agrupa por ID do produto
            ->setParameter('dateLimit', $dateLimit)
            ->getQuery()
            ->getArrayResult(); // Retorna os resultados como um array associativo

        $salesData = [];
        foreach ($results as $row) {
            $salesData[$row['produto_id']] = (int)$row['total_vendido'];
        }

        return $salesData;
    }

    // Adicione seus métodos de consulta personalizados aqui
}
