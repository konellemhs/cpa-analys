<?php

namespace App\Repository\Offer;

use App\Entity\Offer\AdmitadOffer;
use App\Entity\Offer\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
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
     * save offer to database
     *
     * @param Offer $offer
     *
     * @return Offer
     *
     * @throws ORMException
     * @throws \Throwable
     */
    public function save(Offer $offer): Offer
    {
        $this->_em->transactional(
            function () use ($offer) {
                $this->_em->persist($offer);
                $this->_em->flush();
            }
        );

        return $offer;
    }

    /**
     * Search admitad offer by unique field
     *
     * @param int $admitadOfferId
     *
     * @return AdmitadOffer | null
     *
     * @throws NonUniqueResultException
     */
    public function findAdmitadOfferByAdmitadOfferId(int $admitadOfferId): ?AdmitadOffer
    {
        return $this->_em->createQueryBuilder()
            ->select('of')
            ->from(AdmitadOffer::class, 'of')
            ->where('of.admitadOfferId = :offerId')
            ->setParameter('offerId', $admitadOfferId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
