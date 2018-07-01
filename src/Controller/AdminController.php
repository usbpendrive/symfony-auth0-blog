<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $authorRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->blogPostRepository = $entityManager->getRepository('App:BlogPost');
        $this->authorRepository = $entityManager->getRepository('App:Author');
    }

    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $blogPostRepository;

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/admin/author/create", name="author_create")
     */
    public function createAuthorAction(Request $request)
    {
        if ($this->authorRepository->findOneByUsername($this->getUser()->getUsername())) {
            $this->addFlash('error','Unable to create author, author already exists');

            return $this->redirectToRoute('homepage');
        }

        $author = new Author();
        $author->setUsername($this->getUser()->getUsername());

        $form = $this->createForm(AuthorFormType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($author);
            $this->entityManager->flush($author);

            $request->getSession()->set('user_is_author', true);
            $this->addFlash('success', 'Congratulations! You are now an author');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('admin/create_author.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
