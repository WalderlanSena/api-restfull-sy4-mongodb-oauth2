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
    public function findAllOrderByName()
    {
        try {
            $response = $this->documentManager->getRepository(User::class)
                                                 ->findAllOrderedByName();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $response;
    }
}