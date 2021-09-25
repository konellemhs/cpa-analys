<?php

namespace App\Repository\Action;

use App\Entity\Action\Action;
use App\Entity\Action\OfferAction;
use App\Entity\Offer\Offer;
use App\Enum\OfferActionType;
use App\Exception\Entity\CannotSaveEntityException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @method Action | null find($id, $lockMode = null, $lockVersion = null)
 * @method Action | null findOneBy(array $criteria, array $orderBy = null)
 * @method Action[]      findAll()
 * @method Action[]      findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferActionRepository extends ServiceEntityRepository implements OfferActionRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Action::class);
    }

    /**
     * Save Offer Action in database
     *
     * @param OfferAction $offerAction
     *
     * @return OfferAction
     *
     * @throws CannotSaveEntityException
     */
    public function saveOfferAction(OfferAction $offerAction): OfferAction
    {
        try {
            $this->_em->transactional(
                function () use ($offerAction) {
                    $this->_em->persist($offerAction);
                    $this->_em->flush();
                }
            );
        } catch (Throwable $exception) {
            throw new CannotSaveEntityException(
                sprintf('cannot save entity %s because %s', get_class($offerAction), $exception->getMessage()),
                $exception->getCode(),
                $exception
            );
        }

        return $offerAction;
    }

    /**
     * Find offer_action row by offer and action
     *
     * @param Action          $action
     * @param Offer           $offer
     * @param OfferActionType $actionType
     *
     * @return OfferAction | null
     *
     * @throws NonUniqueResultException
     */
    public function findOfferAction(
        Action $action,
        Offer $offer,
        OfferActionType $actionType
    ): ?OfferAction {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('oa')
            ->from(OfferAction::class, 'oa')
            ->join(Offer::class, 'o', Join::WITH, 'oa.offer = o.id')
            ->join(Action::class, 'a', Join::WITH, 'oa.action = a.id')
            ->where('o.id = :offerId')
            ->andWhere('a.id = :actionId')
            ->andWhere('oa.actionType = :actionType')
            ->setParameters([
                'offerId' => $offer->getId(),
                'actionId' => $action->getId(),
                'actionType' => $actionType->getValue(),
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }
}