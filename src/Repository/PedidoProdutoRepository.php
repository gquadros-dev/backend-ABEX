<?php

// src/Repository/PedidoProdutoRepository.php
namespace App\Repository;

use App\Entity\PedidoProduto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PedidoProduto>
 *
 * @method PedidoProduto|null find($id, $lockMode = null, $lockVersion = null)
 * @method PedidoProduto|null findOneBy(array $criteria, array $orderBy = null)
 * @method PedidoProduto[]    findAll()
 * @method PedidoProduto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PedidoProdutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PedidoProduto::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
