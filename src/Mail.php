<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/09/2019
 * Time: 13:15
 */

namespace JhumanJ\GuerillaMail;


/**
 * Represents an email received 
 * 
 * Class Mail
 * @package JhumanJ\GuerillaMail
 */
class Mail
{
    public function __construct(  )
    {

    }

    public static function fromResponse($reponse) {
        return new self();
    }
}