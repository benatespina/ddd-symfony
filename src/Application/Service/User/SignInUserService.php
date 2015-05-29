<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Service\User;

use Ddd\Application\Service\ApplicationService;
use Domain\Exception\User\UserAlreadyExistsException;
use Domain\Factory\User\UserFactory;
use Domain\Model\User\User;
use Domain\Repository\User\PersistentUserRepository;

/**
 * Class SignInUserService.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SignInUserService implements ApplicationService
{
    /**
     * The user repository.
     *
     * @var \Domain\Repository\User\PersistentUserRepository
     */
    private $userRepository;

    /**
     * @var \Domain\Factory\User\UserFactory
     */
    private $userFactory;

    /**
     * Constructor.
     *
     * @param \Domain\Repository\User\PersistentUserRepository $aRepository The repository
     * @param \Domain\Factory\User\UserFactory                 $aFactory    The factory
     */
    public function __construct(PersistentUserRepository $aRepository, UserFactory $aFactory)
    {
        $this->userRepository = $aRepository;
        $this->userFactory = $aFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($request = null)
    {
        if (!$request instanceof SignInUserRequest) {
            throw new \InvalidArgumentException('The request must be SignInUserRequest instance');
        }
        $email = $request->email();
        $password = $request->password();

        $user = $this->userRepository->userOfEmail($email);
        if ($user instanceof User) {
            throw new UserAlreadyExistsException();
        }
        $user = $this->userFactory->register($this->userRepository->nextIdentity(), $email, $password);
        $this->userRepository->save($user);

        return $user;
    }
}
