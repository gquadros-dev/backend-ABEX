<?php

// src/Repository/ProdutoRepository.php
namespace App\Repository;

use App\Entity\Produto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    // Adicione seus métodos de consulta personalizados aqui
}
