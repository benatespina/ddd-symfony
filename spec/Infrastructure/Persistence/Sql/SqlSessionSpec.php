<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Infrastructure\Persistence\Sql;

use Infrastructure\Persistence\Sql\SqlManager;
use PhpSpec\ObjectBehavior;

/**
 * Class SqlSessionSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlSessionSpec extends ObjectBehavior
{
    function let(SqlManager $pdo)
    {
        $this->beConstructedWith($pdo);
    }

    function it_initializable()
    {
        $this->shouldHaveType('Infrastructure\Persistence\Sql\SqlSession');
    }

    function it_implements_TransactionalSession()
    {
        $this->shouldImplement('Ddd\Application\Service\TransactionalSession');
    }

    function it_executes_atomically(SqlManager $pdo)
    {
        $callable = function ($param) { return $param.'bar'; };

        $pdo->transactional($callable)->shouldBeCalled();

        $this->executeAtomically($callable);
    }
}
