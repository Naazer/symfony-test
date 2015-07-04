<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Customer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/app/test-users", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $admin = $em->getRepository('AppBundle:Admin')->findOneBy(['email' => 'admin@test.com']);
        if (empty($admin)) {
            $admin = new Admin();
            $admin->setEmail('admin@test.com');
            $admin->setNickName('super');
            $admin->setPassword('test1');
            $em->persist($admin);
            $em->flush();
        }

        $customer = $em->getRepository('AppBundle:Customer')->findOneBy(['email' => 'customer@test.com']);
        if (empty($customer)) {
            $customer = new Customer();
            $customer->setEmail('customer@test.com');
            $customer->setFirstName('Joe');
            $customer->setLastName('Lyy');
            $customer->setPassword('customer1');
            $em->persist($customer);
            $em->flush();
        }

        $users = $em->getRepository('AppBundle:User')->findAll();
        $str = '';
        foreach ($users as $user) {
            if ($user instanceof Admin) {
                $str .= "<br>Admin (" . $user->getEmail() . "): " . $user->getNickName();
            }
            if ($user instanceof Customer) {
                $str .= "<br>Customer (" . $user->getEmail() . "): " . $user->getFirstName() . ' ' . $user->getLastName();
            }
        }

        return new Response(
            '<html><body'.$str.'</body></html>'
        );
    }
}
