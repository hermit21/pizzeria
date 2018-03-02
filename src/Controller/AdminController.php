<?php

namespace App\Controller;

use App\Classes\InstanceOrder;
use App\Classes\InstancePizza;
use App\Classes\Sanitizing;
use App\Entity\PizzaList;
use App\Entity\Users;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdminController extends Controller
{
    /**
     * @Route("/pizzeria/admin", name="admin")
     */
    public function adminPanel()
    {
        // replace this line with your own code!
        return $this->render('admin/panel.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__) ]);
    }

    /**
     * @Route("/pizzeria/admin/add_pizza", name="add_pizza")
     */
    public function addPizza(SessionInterface $session, Request $request)
    {
        if(empty($session->get('admin_user')))
        {
            return $this->redirectToRoute('login');
        }
        else {
            $pizza_list = new PizzaList();
            $em = $this->getDoctrine()->getManager();

            if ($request->request->get('create_pizza')) {
                $sanitize = new Sanitizing();
                $data_form = $sanitize->sanitizingParameters($request->request);

                $instancePizza = new InstanceOrder($pizza_list);


                $em->persist($instancePizza);
                $em->flush();
            }
        }

        return $this->render('admin/add_pizza.html.twig');
    }

    /**
     * @Route("/pizzeria/admin/update_pizza", name="update_pizza")
     */
    public function updatePizza(SessionInterface $session, Request $request) {


        $pizza_list = array();
        if(empty($session->get('admin_user'))) {
            return $this->redirectToRoute('login');
        }
        else {
            $pizza = new PizzaList();

            $em = $this->getDoctrine();

            $pizza_list = $em->getRepository(PizzaList::class)->findAll();

            if($request->request->get('update_pizza')) {
                $sanitize = new Sanitizing();

                $data_form = $sanitize->sanitizingParameters($request->request);
                $instancePizza = new InstancePizza($pizza);

                $em_pizza = $em->getRepository(PizzaList::class)->find($data_form->id);

                //tutaj jeszcze trzeba przemyśleć
            }
        }

        return $this->render('admin/update_pizza.html.twig',[
            'pizza_list' => $pizza_list
        ]);
    }

    /**
     * @param SessionInterface $session
     * @param Request $request
     * @Route("/pizzeria/admin/edit_user", name="edit_user")
     */
    public function editUsers(SessionInterface $session, Request $request)
    {

        $em = $this->getDoctrine();
        $users = new Users();


        if(empty($session->get('admin_user'))) {
            return $this->redirectToRoute('login');
        } else {

            $users = $em->getRepository(Users::class)->findUsername();

            if($request->request->get('change_user')) {

                $sanitize = new Sanitizing();
                $data_form = $sanitize->sanitizingParameters($request->request);

                $em_user = $em->getManager()->getRepository(Users::class)->findOneBy([
                   'username' => $data_form->username
                ]);

            }

        }

        return $this->render('admin/edit_user.html.twig',[
            'users' => $users
        ]);
    }
}
