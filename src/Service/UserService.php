<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 27/07/18
 * Time: 22:11
 */

namespace App\Service;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function findAllOrderBy()
    {
        try {
            $response = $this->documentManager->getRepository(User::class)->findAllOrderedBy();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        sort($response);

        return $response;
    }

    public function insertUser($request)
    {
        return $this->documentManager->getRepository(User::class)->insert($request);
    }
}