<?php

namespace App\Controller;

use App\Entity\BusinessCard;
use App\Form\BusinessCardType;
use App\Repository\BusinessCardRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BusinessCardController extends AbstractController
{
    /**
     * @Route("/business-cards", name="business_card")
     */
    public function index(BusinessCardRepository $businessCardRepository)
    {
        $user = $this->getUser();
        $businessCards = $businessCardRepository->findByUser($user);

        return $this->render('business_card/index.html.twig', [
            'businessCards' => $businessCards,
        ]);
    }

    /**
     * @Route("/business-cards/add", name="business_card_add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $businessCard = new BusinessCard();
        $businessCard->setUser($user);

        $form = $this->createForm(BusinessCardType::class, $businessCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($businessCard);
            $entityManager->flush();

            return $this->redirectToRoute('business_card');
        }

        return $this->render('business_card/add.html.twig', [
            'businessCardForm' => $form->createView(),

        ]);
    }

    /**
     * @Route("/business-cards/edit/{id}", name="business_card_edit")
     */
    public function edit(BusinessCard $businessCard, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(BusinessCardType::class, $businessCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($businessCard);
            $entityManager->flush();

            return $this->redirectToRoute('business_card');
        }

        return $this->render('business_card/add.html.twig', [
            'businessCardForm' => $form->createView(),

        ]);
    }

    /**
     * @Route("/business-cards/add-user/{id}", name="business_card_add_user")
     */
    public function addUser($id, Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $userToAdd = $userRepository->findOneById($id);

        $businessCard = new BusinessCard();
        $businessCard->setEmail($userToAdd->getEmail());
        $businessCard->setCompany($userToAdd->getCompany());
        $businessCard->setPhone($userToAdd->getPhone());
        $businessCard->setName($userToAdd->getUsername());
        $businessCard->setUser($this->getUser());
        // \dd($businessCard);

        // TODO : Check if not exist un business cards's user
        // TODO : Send a notification to say of userToAdd that this user has added his business card to his library

        $entityManager->persist($businessCard);
        $entityManager->flush();

        return $this->redirectToRoute('business_card');
    }
}
