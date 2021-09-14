<?php

namespace App\Repository\Offer;

use App\Entity\Offer\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer | null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer | null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]      findAll()
 * @method Offer[]      findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository implements OfferRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    /**
     * add offer to database
     *
     * @param Offer $offer
     *
     * @return Offer
     *
     * @throws ORMException
     */
    public function add(Offer $offer): Offer
    {
        $this->_em->persist($offer);

        return $offer;
    }
}
