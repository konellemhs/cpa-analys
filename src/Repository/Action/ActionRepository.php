<?php

namespace App\Repository\Action;

use App\Entity\Action\Action;
use App\Exception\Entity\CannotSaveEntityException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Throwable;

/**
 * @method Action | null find($id, $lockMode = null, $lockVersion = null)
 * @method Action | null findOneBy(array $criteria, array $orderBy = null)
 * @method Action[]      findAll()
 * @method Action[]      findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionRepository extends ServiceEntityRepository implements ActionRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Action::class);
    }

    /**
     * Find action by unique field
     *
     * @param string $name
     *
     * @return Action | null
     */
    public function findActionByName(string $name): ?Action
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Save Action in database
     *
     * @param Action $action
     *
     * @return Action
     *
     * @throws CannotSaveEntityException
     */
    public function save(Action $action): Action
    {
        try {
            $this->_em->transactional(
                function () use ($action) {
                    $this->_em->persist($action);
                    $this->_em->flush();
                }
            );
        } catch (Throwable $exception) {
            throw new CannotSaveEntityException(
                sprintf(
                    'cannot save entity %s because %s',
                    get_class($action),
                    $exception->getMessage()
                ),
                $exception->getCode(),
                $exception
            );
        }

        return $action;
    }
}
