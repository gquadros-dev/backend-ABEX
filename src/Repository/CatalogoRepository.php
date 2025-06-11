<?php

// src/Repository/CatalogoRepository.php
namespace App\Repository;

use App\Entity\Catalogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Catalogo>
 *
 * @method Catalogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catalogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catalogo[]    findAll()
 * @method Catalogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatalogoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Catalogo::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
