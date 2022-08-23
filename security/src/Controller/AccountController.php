<?php

namespace App\Controller;

use App\Entity\Account;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account', name: 'account_')]
class AccountController extends AbstractController
{
    #[Route('/', name: 'overview')]
    #[IsGranted('ROLE_BOOKKEEPER')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }

    #[Route('/{id}', name: 'detail', methods: ['GET'])]
    #[IsGranted('SHOW', subject: 'account')]
    public function show(Account $account): Response
    {
        return $this->render('account/show.html.twig', [
            'account' => $account
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    #[IsGranted('DELETE', subject: 'account')]
    public function delete(Account $account): Response
    {
        return new Response("Deleting account " . $account->getId());
    }
}
