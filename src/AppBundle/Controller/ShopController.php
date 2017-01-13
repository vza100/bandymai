<?php
/**
 * Created by PhpStorm.
 * User: viktoras
 * Date: 17.1.13
 * Time: 17.34
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Car;
use AppBundle\Entity\Cash;
use AppBundle\Entity\Produktas;
use AppBundle\Entity\Shop;
use AppBundle\Entity\Skateboard;
use AppBundle\Form\CarType;
use AppBundle\Form\ShopType;
use AppBundle\Service\MathService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Types\DecimalType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class ShopController extends Controller
{
    /**
     * @Route("/shop",name="shop_page")
     * @param Request $request
     * @return Response
     */
    public function shop(Request $request){
        {
            $product = new Shop();
            $form = $this->createForm(ShopType::class, $product);
            $form->handleRequest($request);

            $repo = $this->getDoctrine()->getRepository('AppBundle:Skateboard');
            $skateboard = $repo->findAll();





            /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
            $session = $request->getSession();

            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;

            // get the error if any (works with forward and redirect -- see below)
            if ($request->attributes->has($authErrorKey)) {
                $error = $request->attributes->get($authErrorKey);
            } elseif (null !== $session && $session->has($authErrorKey)) {
                $error = $session->get($authErrorKey);
                $session->remove($authErrorKey);
            } else {
                $error = null;
            }

            if (!$error instanceof AuthenticationException) {
                $error = null; // The value does not come from the security component.
            }

            // last username entered by the user
            $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

            $csrfToken = $this->has('security.csrf.token_manager')
                ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
                : null;

            $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);





            return $this->render('@FOSUser/Security/shop.html.twig', array(
                'form' => $form->createView(),
                'product' => null,
                'last_username' => $lastUsername,
                'error' => $error,
                'csrf_token' => $csrfToken,
                'user_roles'=>$this->getUser() ? $this->getUser()->getRoles() : null,
                'skateboard'=>$skateboard,
            ));
        }
    }


    /**
     * @Route("/add",name="add_product")
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $product = new Skateboard();

        // Create our form
        $form = $this -> createFormBuilder($product)
            ->add('title',TextType::class)

            ->add('category',ChoiceType::class, array(
                'label' => 'Category',
                'choices' => array(
                    'Pennyboard' => 'Pennyboard',
                    'Skateboard' => 'Skateboard',
                    'Longboard' => 'Longboard',
                )
            ))
            ->add('price',NumberType::class)
            ->add('description',TextareaType::class,array(
                'label' => 'Description',
                'attr' => array('style' => 'width: 100px;',
                'style' => 'height: 75px'
                ),
                'required'    => false,
            ))

            ->add('save',SubmitType::class,array(
                'label' => 'Create',
                'attr' => array('style' => 'width: 100px')
            ))
            ->getForm()
        ;
        $form->handleRequest($request);

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this ->getDoctrine()->getManager();
            $em-> persist($product);
            $em->flush();


            return $this->redirectToRoute('shop_page');
        }



        return $this->render('car/add.html.twig',[
                'product' => $product,
                'forma'=> $form ->createView(),
                'edit' =>false,
                'last_username' => $lastUsername,
                'error' => $error,
                'csrf_token' => $csrfToken,
                'user_roles'=>$this->getUser() ? $this->getUser()->getRoles() : null,
            ]
        );
    }

}