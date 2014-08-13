<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 8/11/14
 * Time: 7:00 PM
 */

namespace Acme\UserBundle\EntityManager;


use Acme\CoreBundle\EntityManagerCore\EntityManager;
use Acme\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\Container;

class UserManager extends EntityManager{

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->setRepository($this->getEntityClassName());
    }

    /**
     * @return string
     */
    public function getEntityClassName()
    {
        return 'Acme\UserBundle\Entity\User';
    }

    /**
     * @param $fbId
     * @return null|object
     */
    public function findByIdFb($fbId)
    {
        $facebookId = $this->getRepository()->findOneBy(array(
            'facebook_id' => $fbId
        ));

        return $facebookId;
    }
} 