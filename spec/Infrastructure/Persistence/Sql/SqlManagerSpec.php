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

use PhpSpec\ObjectBehavior;

/**
 * Class SqlManagerSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlManagerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('mysql:host=localhost;dbname=mysql', 'root', '');
    }

    function it_initializable()
    {
        $this->shouldHaveType('Infrastructure\Persistence\Sql\SqlManager');
    }

    function its_connection()
    {
        $this->connection()->shouldReturnAnInstanceOf('PDO');
    }

    function it_executes()
    {
        $this->execute('SELECT * FROM tablename', null)->shouldReturnAnInstanceOf('PDOStatement');
    }
}
