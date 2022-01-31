<?php

namespace Trappar\AliceGeneratorBundle\Persister;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Trappar\AliceGenerator\Persister\DoctrinePersister as BaseDoctrinePersister;

class DoctrinePersister extends BaseDoctrinePersister
{
    /**
     * @var Registry
     */
    private $doctrine;

    public function __construct(Registry $doctrine)
    {
        parent::__construct($doctrine->getManager());
        $this->doctrine = $doctrine;
    }

    protected function getMetadata($object)
    {
        try {
            $class = $this->getClass($object);

            return $this->doctrine->getManagerForClass($class)->getClassMetadata($class);
        } catch (\Exception $e) {
            return false;
        }
    }
}
