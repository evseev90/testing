<?php

namespace App\Controller;


use App\Entity\Currency;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 * Class ProductController
 * @package App\Controller
 */
class CurrencyController extends AbstractController
{

    /**
     * @Route("/currencies", name="currencies")
     */
    public function index()
    {
        /**
         * EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();

        $currencies = $em->getRepository(Currency::class)->findAll();

        $jsonResponse = $this->json([
            'ok' => true,
            'currencies' => array_map(function ($c) {
                return $c->toArray();
            }, $currencies)
            ,
            'current' => 2
        ]);

        $jsonResponse->headers->set('Access-Control-Allow-Origin', '*');

        return $jsonResponse;
    }
}
