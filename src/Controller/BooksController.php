<?php

namespace App\Controller;

use App\Entity\Books;
use App\Form\BooksType;
use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
  /**
   * @Route("/", name="books")
   * @param BooksRepository $booksRepository
   * @return Response
   */
  public function index(BooksRepository $booksRepository)
  {
    $books = array_reverse($booksRepository->findAll());
    $books = $booksRepository->findBy([], ['id'=>'DESC']);

    return $this->render('books/index.html.twig', [
      'controller_name' => 'BooksController',
      'books' => $books
    ]);
  }


  /**
   * @Route("/create/book", name="createBook")
   * @param Request $request
   * @return RedirectResponse|Response
   */
  public function create(Request $request)
  {
    $book = new Books();

    $form = $this->createForm(BooksType::class, $book, [
        'action' => $this->generateUrl('createBook')
    ]);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

      $em = $this->getDoctrine()->getManager();

      $em->persist($book);
      $em->flush();

      return $this->redirectToRoute('books');
    }

    return $this->render('books/create.html.twig', [
      'createForm' => $form->createView()
    ]);
  }

  /**
   * @Route("/one/book/{book}", name="oneBook")
   * @param Books $book
   * @return Response
   */
  public function show(Books $book)
  {
    return $this->render('books/show.html.twig', [
        'controller_name' => 'BooksController',
        'book' => $book
    ]);
  }

  /**
   * @Route("/edit/book/{book}", name="editBook")
   * @param Books $book
   * @param Request $request
   * @return Response
   */
  public function edit(Books $book, Request $request)
  {
    $id = $book->getId();
    $form = $this->createForm(BooksType::class, $book, [
        'action' => "/edit/book/$id"
    ]);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($book);
      $em->flush();

      return $this->redirectToRoute('books');
    }

    return $this->render('books/edit.html.twig', [
        'editForm' => $form->createView(),
        'id' => $id
    ]);
  }

  /**
   * @Route("/delete/book/{book}", name="deleteBook")
   * @param Books $book
   * @return RedirectResponse
   */
  public function delete(Books $book)
  {
    $em = $this->getDoctrine()->getManager();

    $em->remove($book);
    $em->flush();

    return $this->redirectToRoute('books');
  }
}
