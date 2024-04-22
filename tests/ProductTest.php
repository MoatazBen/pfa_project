<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testName()
    {
        $product = new Product();
        $product->setProductName('Test Product');

        $this->assertEquals('Test Product', $product->getProductName());
    }

    public function testDescription()
    {
        $product = new Product();
        $product->setDescription('Test Description');

        $this->assertEquals('Test Description', $product->getDescription());
    }

    public function testPrice()
    {
        $product = new Product();
        $product->setPrice(10.99);

        $this->assertEquals(10.99, $product->getPrice());
    }
}
