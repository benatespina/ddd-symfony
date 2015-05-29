<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Class AppKernel.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Infrastructure\Symfony\Bundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config.yml');
        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $loader->load(function ($container) {
                $container->loadFromExtension('web_profiler', ['toolbar' => true,]);
            });
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        $filename = '/dev/shm/symfony/cache/';
        if (in_array($this->environment, ['dev', 'test']) && file_exists($filename)) {
            return $filename . $this->environment;
        }

        return __DIR__ . '/../../../../var/cache/' . $this->environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        $filename = '/dev/shm/symfony/logs/';
        if (in_array($this->environment, ['dev', 'test']) && file_exists($filename)) {
            return $filename . $this->environment;
        }

        return __DIR__ . '/../../../../var/logs';
    }
}
