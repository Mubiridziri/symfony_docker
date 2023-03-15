<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\InMemoryUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class SecurityController extends AbstractController
{
    #[Route("/api/v1/login", name: "app_login", methods: ['GET', 'POST'])]
    public function login(#[CurrentUser] ?UserInterface $user): Response
    {
        if (null === $user) {
            return $this->json([
                'message' => "Invalid Credentials"
            ], Response::HTTP_UNAUTHORIZED);
        }
        if($user instanceof InMemoryUser) {
            $user = $this->convertUser($user);
        }

        return $this->json($user, 200, [], [
            AbstractNormalizer::GROUPS => ['View']
        ]);
    }

    #[Route("/api/v1/logout", name: "app_logout", methods: ['GET'])]
    public function logout(): void
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    /**
     * @param InMemoryUser $inMemoryUser
     * @return User
     */
    public function convertUser(InMemoryUser $inMemoryUser): User {
        $user = new User();
        $user->setUsername($inMemoryUser->getUserIdentifier());
        $user->setName($inMemoryUser->getUserIdentifier());
        $user->setRoles($inMemoryUser->getRoles());
        return $user;
    }
}
