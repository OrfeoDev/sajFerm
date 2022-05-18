<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class Messages
{
    // Je fais un service qui va permetre de pouvoir injecter partout dans mon code , jutilise l'interface
    // FlashBag qui provient de httpfoundation, je fais un use de FlashBagInterface et je prepare deux
    // constantes. Ensuite je fais injection de dependance avec mon construteur ce qui me rend plus un code
    // partique et lisible . Je fais eux methode qui vont pendre en parametre le type string et le message
    const TYPE_SUCCESS = " success";
    const TYPE_ERROR = " error";

    /**
     * @var FlashBagInterface
     */
    protected $flashBag;

    /**
     * @param FlashBagInterface $flashBag
     */

    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    /**
     * @param string $message
     * @return mixed
     */

    public function addsuccess(string $message):void
    {
        $this->flashBag->add(self::TYPE_SUCCESS,$message);
    }

    /**
     * @param string $message
     * @return mixed
     */

    public function addError(string $message):void
    {
        $this->flashBag->add(self::TYPE_ERROR,$message);
    }
}