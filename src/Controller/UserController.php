<?php

namespace App\Controller;

use App\Document\User;
use App\Service\UserService;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package App\Controller
 * @Rest\RouteResource("Usuario", pluralize=false)
 */
class UserController extends FOSRestController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAction()
    {
//        $doctrine = $this->container->get('doctrine_mongodb')
//                                    ->getManager()
//                                    ->getRepository(User::class)->findAllOrderedByName();
        $doctrine = '';
        try {
            $doctrine = $this->userService->findAllOrderByName();
        } catch (\Exception $exception) {

        }

        return new JsonResponse([
            'status' => true,
            'data'   => $doctrine,
            'errors' => null,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function postAction(Request $request)
    {
        $request = json_decode($request->getContent());

        $doctrine = $this->container->get('doctrine_mongodb')->getManager();

        $user = new User();
        $user->setNome($request->nome);
        $user->setIdade($request->idade);

        $doctrine->persist($user);
        $doctrine->flush();

        return new JsonResponse([
            'status'    => true,
            'message'   => 'Novo usuario cadastrado com sucesso !',
            'data'      => [
                'nome'  => $user->getNome(),
                'idade' => $user->getIdade()
            ],
            'errors'    => null
        ]);
    }
}
