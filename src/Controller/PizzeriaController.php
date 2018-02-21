<?php

namespace App\Controller;

use App\Classes\Instances;
use App\Entity\Comments;
use App\Entity\Components;
use App\Entity\PizzaList;
use App\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Classes\Hash;

class PizzeriaController extends Controller
{

    /**
     * @Route("/pizzeria", name="pizzeria")
     */
    public function index(Request $request, SessionInterface $session)
    {
        return $this->render('pizzeria/panel.html.twig');
    }

    /**
     * @Route("/pizzeria/login", name="login")
     */
    public function login(Request $request, SessionInterface $session)
    {
        $session->start();
        $session->set('user_id', 3);

        if($request->request->get('login')) {
            $hash_obj = new Hash();

            $user = new Users();

            $login_user = $hash_obj->sanetizeParameters($request->request);
            $em = $this->getDoctrine();
            $user = $em->getRepository(Users::class)->findOneBy([
                'username' => $login_user->username,
                'activate_token' => 'activate'
            ]);

            if(!empty($user) && ($hash_obj->compareValues($login_user->password, $user->getSalt(), $user->getPassword())) ) {

                $session->start();
                $session->set('user_id', $user->getId());

                if ($user->getPrivilageUser() == 2) {
                    return $this->redirectToRoute('employee');
                }
                else if($user->getPrivilageUser() == 3) {
                    return $this->redirectToRoute('admin');
                } else {
                    return $this->redirectToRoute('pizzeria');
                }

            }
            else {
                echo '<script type="text/javascript">alert("Passowrd or E-mail is not correct")</script>';
            }
        }

        return $this->render('pizzeria/login.html.twig');
    }

    /**
     * @Route("/pizzeria/register", name="register")
     */
    public function register(Request $request)
    {
        $register_data = new \stdClass();

        if($request->request->get('register'))
        {
            $hash_obj = new Hash();
            $salt = $hash_obj->generateToken(20);
            $activate_token = $hash_obj->generateToken(12);
            $password_token = $hash_obj->generateToken(12);

            $register_data = $hash_obj->sanetizeParameters($request->request);
            $register_data->salt = $hash_obj->hashToken($salt);
            $register_data->activate_token = $hash_obj->hashToken($activate_token);
            $register_data->password_token = $hash_obj->hashToken($password_token);
            $register_data->password = $hash_obj->makeHash($register_data->password, $register_data->salt);

            $user_obj = new Instances();


            $user = $user_obj->setRegisterData($register_data);
            echo '<script type="text/javascript">alert("' . $activate_token . '")</script>';
            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();


        }
        return $this->render('pizzeria/register.html.twig', array('user_data' => $register_data));
    }

    /**
     * @Route("/pizzeria/activate_account", name="activate_account")
     */
    public function activateAccount(Request $request)
    {
        $hash_obj = new Hash();


        if($request->request->get('active_token'))
        {
            $em = $this->getDoctrine();
            $user = new Users();

            // Data from the form (username, token)
            $http_data = $hash_obj->sanetizeParameters($request->request);
            $user = $em->getRepository(Users::class)->findOneBy([
                'username' => $http_data->username,
                'activate_token' => $hash_obj->hashToken($http_data->token)
            ]);

            if(empty($user))
            {
                //error token nie istnieje albo user
            }
            else {
                $ative_account = $em->getManager();


                $user->setActivateToken("activate");
                $ative_account->flush();

                return $this->redirectToRoute('login');
            }
        }

        return $this->render('pizzeria/activate_account.html.twig');
    }

    /**
     * @Route("/pizzeria/salary", name="salary")
     */
    public function salary(SessionInterface $session)
    {
        $id = $session->get('user_id');
        $em = $this->getDoctrine();
        $user = new Users();
        if(!empty($id)) {
           $user = $em->getRepository(Users::class)->find($id);


        }


        return $this->render('pizzeria/salary.html.twig', array('user' => $user->getUsername()));
    }

    /**
     * @Route("/pizzeria/about", name="about")
     */
    public function aboutUs(SessionInterface $session)
    {

        return $this->render('pizzeria/about.html.twig');
    }

    /**
     * @Route("/pizzeria/menu", name="menu")
     */
    public function menu(SessionInterface $session, Request $request)
    {
        $id = $session->get('user_id');
        $em = $this->getDoctrine();
        $user = new Users();

        $user = $em->getRepository(Users::class)->find($id);

        $pizzaList = new PizzaList();

        $pizzaList = $em->getRepository(PizzaList::class)->findAll();

        if($request->request->get('order')) {

            $hash_obj = new Hash();
            $order_data = $hash_obj->sanetizeParameters($request->request);

        } else if($request->request->get('create_own_pizza')) {

            return $this->redirectToRoute('own_pizza');
        }

        return $this->render('pizzeria/menu.html.twig', array(
            'user' => $user->getUsername(),
            'pizza_list' => $pizzaList
        ));
    }

    /**
     * @Route("/pizzeria/menu/new_pizza", name="new_pizza")
     */
    public function ownPizza(SessionInterface $session, Request $request)
    {
        $components = new Comments();

        $em = $this->getDoctrine();

        $components = $em->getRepository(Components::class)->findAll();

        if($request->request->get('order_pizza')  && !empty($session->get('user_id')) ) {

            $hash_obj = new Hash();
            $data_from_form = $hash_obj->sanetizeParameters($request->request);

            $orders = new Orders();
            $em_order = $em->getManager();

            if($request->request->get('accept_order')) {

                $orderInstane = new Instances();
                $orders = $orderInstane->setOrder($data_from_form);

                $em_order->persist($orders);
                $em_order->flush();
            }
            else {
                return $this->redirectToRoute('new_pizza');
            }
        }
        else {
            return $this->redirectToRoute('menu');
        }

        return $this->render('pizzeria/new_pizza', array('pizza_components' => $components));

    }
}
