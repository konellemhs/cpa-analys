<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test")
     *
     * @return JsonResponse
     */
    public function test(): JsonResponse
    {
        dd($this);

        return new JsonResponse('ok');
    }
}
