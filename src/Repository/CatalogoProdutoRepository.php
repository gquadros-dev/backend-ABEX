<?php

// src/Repository/CatalogoProdutoRepository.php
namespace App\Repository;

use App\Entity\CatalogoProduto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatalogoProduto>
 *
 * @method CatalogoProduto|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatalogoProduto|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatalogoProduto[]    findAll()
 * @method CatalogoProduto[]    findBy(array array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatalogoProdutoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatalogoProduto::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
