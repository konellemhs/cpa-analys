<?php

namespace App\Repository\Offer;

use App\Entity\Offer\AdmitadOffer;
use App\Entity\Offer\Offer;
use App\Exception\Entity\CannotSaveEntityException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @method Offer | null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer | null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]      findAll()
 * @method Offer[]      findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository implements OfferRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
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
     * @throws CannotSaveEntityException
     */
    public function save(Offer $offer): Offer
    {
        try {
            $this->_em->transactional(
                function () use ($offer) {
                    $this->_em->persist($offer);
                    $this->_em->flush();
                }
            );
        } catch (Throwable $exception) {
            throw new CannotSaveEntityException(
                sprintf(
                    'cannot save entity %s because %s',
                    get_class($offer),
                    $exception->getMessage()
                ),
                $exception->getCode(),
                $exception
            );
        }

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
