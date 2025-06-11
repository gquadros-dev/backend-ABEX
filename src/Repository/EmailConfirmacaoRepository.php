<?php

// src/Repository/EmailConfirmacaoRepository.php
namespace App\Repository;

use App\Entity\EmailConfirmacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmailConfirmacao>
 *
 * @method EmailConfirmacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailConfirmacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailConfirmacao[]    findAll()
 * @method EmailConfirmacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailConfirmacaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailConfirmacao::class);
    }

    // Adicione seus métodos de consulta personalizados aqui
}
