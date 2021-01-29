<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\EditeUserType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RegistrationFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Security\LoginFormAuthentificatiorAuthenticator;


#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
#[Route('/', name: 'index')]

    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/users", name="user")
     */
    public function userslist(UserRepository $users)
    {
return $this ->render("admin/users.html.twig", [
    'users'=>$users->findAll()
]);
    }
/**
 * @Route("/user/edite/{id}",name="edite_user")
 */
    public function editUser(User $user,Request $request){
        $form = $this->createForm(EditeUserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message','user edit with succes');
            return $this->redirectToRoute('admin_user');
        }
        return $this->render('admin/edituser.html.twig', [
            'userForm' => $form->createView()
        ]);
    }



    /**
 * @Route("/register",name="app_register")
 */
      public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthentificatiorAuthenticator $authenticator): Response
      {
          $user = new User();
          $form = $this->createForm(RegistrationFormType::class, $user);
          $form->handleRequest($request);
  
          if ($form->isSubmitted() && $form->isValid()) {
              // encode the plain password
              $user->setPassword(
                  $passwordEncoder->encodePassword(
                      $user,
                      $form->get('plainPassword')->getData()
                  )
              );
  
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($user);
              $entityManager->flush();

              $this->addFlash('message','user edit with succes');
            return $this->redirectToRoute('admin_user');
              // do anything else you need here, like send an email
  
            //   return $guardHandler->authenticateUserAndHandleSuccess(
            //       $user,
            //       $request,
            //       $authenticator,
            //       'main' // firewall name in security.yaml
            //   );
          }
  
          return $this->render('registration/register.html.twig', [
              'registrationForm' => $form->createView(),
          ]);
      }
}
