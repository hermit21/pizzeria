<?php

namespace App\Controller;

use App\Entity\Orders;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EmployeeController extends Controller
{
    /**
     * @Route("/pizzeria/employee", name="employee")
     */
    public function employeePanel(SessionInterface $session, Reguest $reguest)
    {
        return $this->render('@Maker/demoPage.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__) ]);
    }

    public function listOrders(SessionInterface $session, Request $request)
    {
        $em = $this->getDoctrine();

        $order = new Orders();

        $em_orders = $em->getRepository(Orders::class)->findAll();

        if($request->request->get('completed')) {

            $id_order = $request->request->get('id_order');

            $em_order_rm = $em->getManager();

            $order = $em->getRepository(Orders::class)->find($id_order);

            $em_order_rm->remove($order);
            $em_order_rm->flush();

            //tutaj jeszcze można dodać powiadomienia mailowe że pizza jest zrobiona;
        }

        return $this->render('employee/orders.html.twig');
    }
}
