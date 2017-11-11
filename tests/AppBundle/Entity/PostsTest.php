<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 11.11.17
 * Time: 13:37
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Posts;
use PHPUnit\Framework\TestCase;

class PostsTest extends TestCase
{
    public function testSetDate()
    {
        $post = new Posts();
        $post->setDate('11.11.2017');
        $this->assertEquals('11.11.2017', $post->getDate());
    }
}