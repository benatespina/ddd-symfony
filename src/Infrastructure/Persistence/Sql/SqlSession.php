<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Persistence\Sql;

use Ddd\Application\Service\TransactionalSession;

/**
 * Class SqlSession.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlSession implements TransactionalSession
{
    /**
     * The manager.
     *
     * @var \Infrastructure\Persistence\Sql\SqlManager
     */
    private $manager;

    /**
     * Constructor.
     *
     * @param \Infrastructure\Persistence\Sql\SqlManager $manager The sql manager
     */
    public function __construct(SqlManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritDoc}
     */
    public function executeAtomically(callable $operation)
    {
        return $this->manager->transactional($operation);
    }
}
