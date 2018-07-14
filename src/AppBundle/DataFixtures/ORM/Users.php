<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Users
 * @package AppBundle\DataFixtures\ORM
 */
class Users extends Fixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $phone = 666666666;

        for ($i = 1; $i <= 50; $i ++) {

            /** @var User $user */
            $user = $userManager->createUser();
            $user->setName('User ' . $i)
                ->setSurname('Surname ' . $i)
                ->setPhone($phone++)
                ->setBalance(rand(5, 50))
                ->setEmail('user' . $i . '@footballbets.com')
                ->setUsername('user' . $i)
                ->setEnabled(1)
                ->setPlainPassword('user' . $i);
            $userManager->updateUser($user);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
