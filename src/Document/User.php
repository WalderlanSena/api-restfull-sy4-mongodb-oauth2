<?php
/**
 * Created by PhpStorm.
 * User: Walderlan Sena <senawalderlan@gmail.com>
 * Date: 27/07/18
 * Time: 17:34
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class User
 * @package App\Document
 * @MongoDB\Document(repositoryClass="\App\Repository\UserRepository")
 */
class User
{
    /**
     * @MongoDB\Id
     */
    public $id;

    /**
     * @var string
     * @MongoDB\Field(type="string")
     */
    public $nome;

    /**
     * @var int
     * @MongoDB\Field(type="int")
     */
    public $idade;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return User
     */
    public function setNome(string $nome): User
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdade(): int
    {
        return $this->idade;
    }

    /**
     * @param int $idade
     * @return User
     */
    public function setIdade(int $idade): User
    {
        $this->idade = $idade;
        return $this;
    }
}