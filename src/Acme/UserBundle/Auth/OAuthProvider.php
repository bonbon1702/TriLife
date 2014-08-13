<?php
/**
 * Created by PhpStorm.
 * User: tuan
 * Date: 8/10/14
 * Time: 8:40 PM
 */

namespace Acme\UserBundle\Auth;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Acme\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\Container;

class OAuthProvider extends OAuthUserProvider{

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param UserResponseInterface $response
     * @return \HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser|\Symfony\Component\Security\Core\User\UserInterface
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        //Data from Facebook response
        $facebook_id = $response->getUsername(); /* An ID like: 112259658235204980084 */

        //get service
        $userManager = $this->container->get('acme.entity_manager.user');

        //getdata
        $fb_id = $userManager->findByIdFb($facebook_id);
        $email = $response->getEmail();
        $image_url = $response->getProfilePicture();
        $full_name = $response->getRealName();

        //add to database if doesn't exists
        if ($fb_id == null){
            $user = new User();
            $user->setFacebookId($facebook_id);
            $user->setEmail($email);
            $user->setFullName($full_name);
            $user->setImageUrl($image_url);
            $userManager->persist($user);
            $userManager->flush();
        }

        return $this->loadUserByUsername($response->getUsername());
    }
} 