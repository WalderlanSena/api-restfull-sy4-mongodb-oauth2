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
use Doctrine\ODM\MongoDB\MongoDBException;

class UserRepository extends DocumentRepository
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function findAllOrderedByName()
    {
        $response = $this->createQueryBuilder()->exclude('nome')->getQuery()->execute();
//        $response = $this->createQueryBuilder()
//        try {
//            $response = $this->getDocumentManager()->getRepository(User::class)->findAll();
//        } catch (MongoDBException $exception) {
//            throw new \Exception($exception->getMessage());
//        }

        return $response;
    }

}