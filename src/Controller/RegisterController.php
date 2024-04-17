<?php 
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class RegisterController extends AbstractController
{
    private $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $manager): Response
    {
        $formRegister = $this->createFormBuilder()
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
            ])
            ->getForm();

        $formRegister->handleRequest($request);

        if ($formRegister->isSubmitted() && $formRegister->isValid()) {
            $userData = $formRegister->getData();
            $user = new User();
            $user->setName($userData['name']);
            $user->setEmail($userData['email']);
            $user->setPhone($userData['phone']);
            $encodedPassword = $this->passwordEncoder->hashPassword($user, $userData['password']);
            $user->setPassword($encodedPassword);
           
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', 'Your account has been created successfully. You can now log in.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/login.html.twig', [
            'form_register' => $formRegister->createView(),
        ]);
    }

}