<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 27/07/18
 * Time: 19:25
 */

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
        try {
            $doctrine = $this->userService->findAllOrderBy();
        } catch (\Exception $exception) {
            return new JsonResponse([
                'status' => false,
                'data'   => null,
                'errors' => [
                    'Não foi possível concluir a requisição Erro: '. $exception->getMessage()
                ],
            ]);
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

        try {
            $user = $this->userService->insertUser($request);
        } catch (\Exception $exception) {
            return new JsonResponse([
                'status' => false,
                'data'   => null,
                'errors' => [
                    'Não foi possível concluir a requisição Erro: '. $exception->getMessage()
                ],
            ]);
        }

        return new JsonResponse([
            'status'    => true,
            'message'   => 'Novo usuario cadastrado com sucesso !',
            'data'      => [
                'nome'  => $user->getNome(),
                'email' => $user->getEmail(),
                'idade' => $user->getIdade()
            ],
            'errors'    => null
        ]);
    }
}
