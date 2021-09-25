<?php

namespace App\Repository\Action;

use App\Entity\Action\Action;

interface ActionRepositoryInterface
{
    /**
     * Find action by unique field
     *
     * @param string $name
     *
     * @return Action | null
     */
    public function findActionByName(string $name): ?Action;

    /**
     * Save Action in database
     *
     * @param Action $action
     *
     * @return Action
     */
    public function save(Action $action): Action;
}
