<?php


namespace AppBundle\Controller;

use AppBundle\Book\Command\AddBookCommand;
use AppBundle\Book\Command\DeleteBookCommand;
use AppBundle\Book\Command\EditBookCommand;
use AppBundle\Form\AddBookForm;
use AppBundle\Form\DeleteBookForm;
use AppBundle\Form\EditBookForm;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BookController
 * @package AppBundle\Controller
 */
final class BookController extends FOSRestController
{

    /**
     * This method return all books
     *
     * @Rest\Get("/api/get/all/books")
     *
     * @return Response
     */
    public function getAllBook(): Response
    {
        $booksQuery = $this->get('appbundle\book\queryview\booksview');
        $view = $this->view($booksQuery->getAll(), 200);
        return $this->handleView($view);
    }

    /**
     * This method return single book
     *
     * @Rest\Get("/api/panel/get/book/{id}")
     *
     * @return Response
     */
    public function getSingleBook(Request $request, string $id): Response
    {
        $userId = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getId();

        $booksQuery = $this->get('appbundle\book\queryview\booksview');
        $view = $this->view($booksQuery->getSingle($id, $userId), 200);
        return $this->handleView($view);
    }

    /**
     * This method return all user books
     *
     * @Rest\Get("/api/panel/get/user/book")
     *
     * @return Response
     */
    public function getAllUserBooks(Request $request): Response
    {
        $userId = $this->container
            ->get('security.token_storage')
            ->getToken()
            ->getUser()
            ->getId();

        $booksQuery = $this->get('appbundle\book\queryview\booksview');
        $view = $this->view($booksQuery->getAllUserBooks($userId), 200);
        return $this->handleView($view);
    }

    /**
     * This method added new book
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Put("/api/panel/add/book")
     */
    public function addBook(Request $request): Response
    {

        $data = [
            "name"=> $request->request->get("name"),
            "description"=> $request->request->get("description"),
            "address"=> $request->request->get("address"),
            "lat" => $request->request->get("lat"),
            "lng" => $request->request->get("lng"),
            "type" => $request->request->get("type"),
            "user" => $this->container
                ->get('security.token_storage')
                ->getToken()
                ->getUser()
                ->getId()
        ];


        $addCategory = new AddBookCommand(
            $data['name'],
            $data['description'],
            $data['address'],
            $data['lat'],
            $data['lng'],
            $data['type'],
            $data['user']
        );

        $form = $this->createForm(AddBookForm::class, $addCategory);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle(
                $addCategory
            );
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);
    }

    /**
     * This method deleted book
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Delete("/api/delete/{id}/book")
     */
    public function deleteBook(Request $request, string $id): Response
    {
        $idBook = ["idBook" => $id];
        $deleteBook = new DeleteBookCommand($id);

        $form = $this->createForm(DeleteBookForm::class, $deleteBook);
        $form->submit($idBook);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle(
                $deleteBook
            );
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);
    }

    /**
     * This method edit book
     *
     * @param Request $request request object
     * @return Response
     *
     * @Rest\Post("/api/panel/edit/book")
     */
    public function editBook(Request $request): Response
    {
        $idBook = $request->request->get("idbook");
        $name = $request->request->get("name");
        $description = $request->request->get("description");
        $address = $request->request->get("address");
        $lat = $request->request->get("lat");
        $lng = $request->request->get("lng");
        $type = $request->request->get("type");

        $editBook = new EditBookCommand(
            $idBook,
            $name,
            $description,
            $address,
            $lat,
            $lng,
            $type
        );

        $data = [
            'idBook' => $idBook,
            'name' => $name,
            'description' => $description,
            'address' => $address,
            'lat' => $lat,
            'lng' => $lng,
            'type' => $type,
        ];

        $form = $this->createForm(EditBookForm::class, $editBook);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle(
                $editBook
            );
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);
    }
}