<?php
/**
 * Created by PhpStorm.
 * User: GARCII
 * Date: 2/3/2017
 * Time: 11:16 PM
 */

namespace Karhabty\UserBundle\Form;

use Symfony\Component\Form\DataTransformerInterface;

use Symfony\Component\Form\Exception\TransformationFailedException;


class StringToArrayTransformer implements DataTransformerInterface{


    public function transform($array)

    {

        return $array[0];

    }

    public function reverseTransform($string)

    {

        return array($string);

    }


}