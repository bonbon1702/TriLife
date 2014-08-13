<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 8/11/14
 * Time: 6:58 PM
 */

namespace Acme\CoreBundle\EntityManagerCore;


use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManager as EM;
use Doctrine\ORM\EntityRepository;

class EntityManager {
    /**
     * Store app container
     * @var Container
     */
    protected $container;

    /**
     * @var EM
     */
    protected $entityManager;

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->entityManager = $container->get('doctrine')->getManager();
    }

    /**
     * Flush entity
     */
    public function flush()
    {
        $this->entityManager->flush();
    }

    /**
     * Get repo
     * @param $name
     * @return \Doctrine\ORM\EntityRepository
     */
    public function setRepository($name)
    {
        $this->repository = $this->entityManager->getRepository($name);
        return $this->repository;
    }

    /**
     * @param mixed $entity
     * @param bool $flush
     */
    public function persist($entity, $flush = false)
    {
        $this->entityManager->persist($entity);
        if ($flush) {
            $this->entityManager->flush();
        }
    }

    /**
     * Find and get all
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

}