<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 27/07/18
 * Time: 19:25
 */

namespace App\Repository;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentRepository;

class UserRepository extends DocumentRepository
{
    /**
     * @return array
     */
    public function findAllOrderedBy()
    {
        $response = $this->getDocumentManager()->createQueryBuilder()
                                               ->find(User::class)
                                                ->getQuery()->toArray();
        return $response;
    }

    /**
     * @param $request
     * @return User
     */
    public function insert($request)
    {
        $doctrine = $this->getDocumentManager();

        $user = new User();
        $user->setNome($request->nome);
        $user->setEmail($request->email);
        $user->setIdade($request->idade);

        $doctrine->persist($user);
        $doctrine->flush();

        return $user;
    }

}