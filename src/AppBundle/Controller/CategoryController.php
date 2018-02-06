<?php

namespace AppBundle\Controller;


use AppBundle\Command\AddCategoryCommand;
use AppBundle\Command\EditCategoryCommand;
use AppBundle\Entity\Category;
use AppBundle\Form\AddCategoryForm;
use AppBundle\Form\EditCategoryForm;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 *
 * @package AppBundle\Controller
 */
final class CategoryController extends FOSRestController
{
    /**
     * This method return all categories
     *
     * @Rest\Get("/api/get/all/categories")
     *
     * @return Response
     */
    public function getAllCategories(): Response
    {
        $categoryProvider = $this->get('appbundle\provider\categoryprovider');
        $view = $this->view($categoryProvider->getAll(), 200);
        return $this->handleView($view);
    }

    /**
     * This method return single category
     *
     * @param Request $request request object
     * @param string $id category id
     *
     * @return Response
     *
     * @Rest\Get("/api/get/{id}/category")
     */
    public function getSingleCategory(Request $request, string $id): Response
    {
        $categoryProvider = $this->get('appbundle\provider\categoryprovider');
        $view = $this->view($categoryProvider->getSingle($id), 200);
        return $this->handleView($view);
    }

    /**
     * This method return all categories
     *
     * @param Request $request request object
     *
     * @return Response
     *
     * @Rest\Put("/api/add/category")
     */
    public function addCategory(Request $request): Response
    {
        $name = $request->request->get("name");
        $description = $request->request->get("description");
        $addCategory = new AddCategoryCommand($name, $description);
        $form = $this->createForm(AddCategoryForm::class, $addCategory);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle(
                $addCategory
            );
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 200);
        return $this->handleView($view);
    }

    /**
     * This method edit category
     *
     * @param Request $request request object
     * @param string $id category id
     *
     * @return Response
     *
     * @Rest\Post("/api/edit/{id}/category")
     */
    public function editCategory(Request $request, string $id): Response
    {
        $name = $request->request->get("name");
        $description = $request->request->get("description");
        $editCategory = new EditCategoryCommand($id, $name, $description);

        $form = $this->createForm(EditCategoryForm::class, $editCategory);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle(
                $editCategory
            );
            $view = $this->view('success', 200);
            return $this->handleView($view);
        }

        $view = $this->view($form->getErrors(), 500);
        return $this->handleView($view);
    }

    /**
     * This method edit category
     *
     * @param Request $request request object
     * @param string $id category id
     *
     * @return Response
     *
     * @Rest\Delete("/api/delete/{id}/category")
     */
    public function delCategory(Request $request, string $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $entityManager->getRepository(Category::class);
        $repository->remove($id);

        $view = $this->view('success', 200);
        return $this->handleView($view);
    }
}