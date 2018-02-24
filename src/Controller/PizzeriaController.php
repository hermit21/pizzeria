<?php

namespace App\Controller;

use App\Classes\EncryptData;
use App\Classes\Errors;
use App\Classes\InstanceOrder;
use App\Classes\InstancesRegistration;
use App\Classes\Sanitizing;
use App\Classes\Tokens;
use App\Classes\Validation;
use App\Entity\Comments;
use App\Entity\Components;
use App\Entity\Orders;
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
        $message_error = array();

        if($request->request->get('register'))
        {

            $sanitize = new Sanitizing();

            $validate = new Validation($sanitize);

            if($validate->validElements($register_data)) {

                $tokens = new Tokens();

                $activate_token = $tokens->generateToken(12);
                $password_token = $tokens->generateToken(12);
                $salt = $tokens->generateToken(20);

                $register_data->activate_token = $tokens->hashToken($activate_token);
                $register_data->password_token = $tokens->hashToken($password_token);
                $register_data->password = $tokens->makeHash($register_data->password, $register_data->salt);

                $user = new Users();

                $instanceRegistration = new InstancesRegistration($user);

                $user = $instanceRegistration->setRegisterData($register_data);

                $em = $this->getDoctrine()->getManager();
                echo '<script type="text/javascript">alert("' . $activate_token . '")</script>';
                $em->persist($user);
                $em->flush();

            }
            else {
              $message_error = $validate->displayError();
            }

        }
        return $this->render('pizzeria/register.html.twig', array(
            'user_data' => $register_data,
            'errors' => $message_error
        ));
    }

    /**
     * @Route("/pizzeria/activate_account", name="activate_account")
     */
    public function activateAccount(Request $request)
    {
        $sanitizing = new Sanitizing();
        $validation = new Validation($sanitizing);

        $error_message = array();

        if($request->request->get('active_token'))
        {
            $em = $this->getDoctrine();
            $user = new Users();
            $token = new Tokens();

            // Data from the form (username, token)
            if($validation->validElements($request->request)) {
                $user = $em->getRepository(Users::class)->findOneBy([
                    'username' => $http_data->username,
                    'activate_token' => $token->hashToken($http_data->token)
                ]);

                if(!empty($user)) {
                    //token exist
                    $em_user = $em->getManager();
                    $user->setActivateToken('activate');

                    $em_user->flush();

                }
                else {
                    $error_message['activate_token'] = "Token or username are incorrect";
                }
            }
            else {
               $error_message = $validation->displayError();
            }

        }

        return $this->render('pizzeria/activate_account.html.twig' , array(
            'errors' => $error_message
        ));
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

        $sanitizing = new Sanitizing();
        $validation = new Validation($sanitizing);

        if($request->request->get('order')) {

            $orders = new Orders();

            if($validation->validElements($request->request))
            {
                if($request->request->get('accept_order'))
                {
                    $instanceOrder = new InstanceOrder($orders);

                    $em = $this->getDoctrine()->getManager();

                    $em->persist($instanceOrder);

                    $em->flush();

                    //adding message to telephone regarding pizza order has been prepared for the implementation
                }

            }
            else {
                //some error will be displayed;
            }


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

                $orderInstane = new InstancesRegistration();
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
