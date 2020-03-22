<?php

namespace App\Controller;

use App\Entity\ProductAttribute;
use App\Form\ProductAttributeType;
use App\Repository\ProductAttributeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/attribute")
 */
class ProductAttributeController extends AbstractController
{
    /**
     * @Route("/", name="product_attribute_index", methods={"GET"})
     * @param ProductAttributeRepository $productAttributeRepository
     * @return Response
     */
    public function index(ProductAttributeRepository $productAttributeRepository): Response
    {
        return $this->render('product_attribute/index.html.twig', [
            'product_attributes' => $productAttributeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_attribute_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $productAttribute = new ProductAttribute();
        $form = $this->createForm(ProductAttributeType::class, $productAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productAttribute);
            $entityManager->flush();

            return $this->redirectToRoute('product_attribute_index');
        }

        return $this->render('product_attribute/new.html.twig', [
            'product_attribute' => $productAttribute,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_attribute_show", methods={"GET"})
     * @param ProductAttribute $productAttribute
     * @return Response
     */
    public function show(ProductAttribute $productAttribute): Response
    {
        return $this->render('product_attribute/show.html.twig', [
            'product_attribute' => $productAttribute,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_attribute_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ProductAttribute $productAttribute
     * @return Response
     */
    public function edit(Request $request, ProductAttribute $productAttribute): Response
    {
        $form = $this->createForm(ProductAttributeType::class, $productAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_attribute_index');
        }

        return $this->render('product_attribute/edit.html.twig', [
            'product_attribute' => $productAttribute,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_attribute_delete", methods={"DELETE"})
     * @param Request $request
     * @param ProductAttribute $productAttribute
     * @return Response
     */
    public function delete(Request $request, ProductAttribute $productAttribute): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productAttribute->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productAttribute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_attribute_index');
    }
}
