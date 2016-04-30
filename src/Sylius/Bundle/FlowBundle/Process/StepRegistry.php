<?php

namespace Sylius\Bundle\FlowBundle\Process;

use Sylius\Bundle\FlowBundle\Process\Step\StepInterface;
use Sylius\Component\Registry\NonExistingServiceException;
use Sylius\Component\Registry\ServiceRegistry;

class StepRegistry extends ServiceRegistry implements \Countable, \IteratorAggregate, \ArrayAccess
{
    /** @var StepInterface[] */
    protected $namedSteps = [];

    /** @var StepInterface[] */
    protected $positionedSteps = [];

    public function __construct()
    {
        parent::__construct(StepInterface::class, 'step');
    }

    /**
     * @param string $name
     * @param StepInterface $service
     * @param null|int $position
     */
    public function register($name, $service, $position = null)
    {
        if (isset($this->namedSteps[$name])) {
            throw new \OutOfBoundsException(sprintf(
                'Step "%s" with name "%s" would get replaced by step "%s".',
                get_class($this->namedSteps[$name]),
                $name,
                get_class($service)
            ));
        }

        $this->namedSteps[$name] = $service;

        if (null === $position) {
            if (isset($this->positionedSteps[$position])) {
                throw new \OutOfBoundsException(sprintf(
                    'Step "%s" at position %d would get replaced by step "%s".',
                    get_class($this->positionedSteps[$position]),
                    $position,
                    get_class($service)
                ));
            }

            $this->positionedSteps[$position] = $this->namedSteps[$name];
        } else {
            $this->positionedSteps[] = $this->namedSteps[$name];
        }

        ksort($this->positionedSteps);
    }

    /**
     * @param int $position
     *
     * @return StepInterface
     */
    public function getStepAtPosition($position)
    {
        return $this->positionedSteps[$position] ?: null;
    }

    /**
     * @return StepInterface
     */
    public function getFirstStep()
    {
        return $this->getStepAtPosition(0) ?: reset($this->positionedSteps);
    }

    /**
     * @return StepInterface
     */
    public function getLastStep()
    {
        return $this->getStepAtPosition($this->count() - 1);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->positionedSteps);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->positionedSteps);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->register($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->unregister($offset);
    }

    /**
     * @param string $name
     *
     * @throws NonExistingServiceException
     */
    public function unregister($name)
    {
        if (!$this->has($name)) {
            throw new NonExistingServiceException($this->context, $name, array_keys($this->namedSteps));
        }

        $index = array_search($this->namedSteps[$name], $this->positionedSteps);

        unset($this->namedSteps[$name], $this->positionedSteps[$index]);

        // Keep sequential index intact.
        $this->positionedSteps = array_values($this->positionedSteps);
    }

    /**
     * @return StepInterface[]
     */
    public function getPositionedSteps()
    {
        return $this->positionedSteps;
    }
}
