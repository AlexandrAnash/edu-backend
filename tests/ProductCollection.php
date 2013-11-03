<?php
require_once __DIR__ . '/../src/ProductCollection.php';
require_once __DIR__ . '/../src/Product.php';

$products = new ProductCollection([new Product(['sku' => 'fuu']),
    new Product(['sku' => 'bar']), new Product(['sku' => 'bar'])]);
if (assert(($products->getProducts() == [new Product(['sku' => 'fuu']),
        new Product(['sku' => 'bar']), new Product(['sku' => 'bar'])]), "Return the products")
)
    echo '.';

$products = new ProductCollection([new Product([]), new Product([])]);
if (assert(($products->getSize() == 2), "Return size products"))
    echo '.';
$products = new ProductCollection([new Product([])]);
if (assert(($products->getSize() == 1), "Return size products"))
    echo '.';

$products = new ProductCollection([new Product(['sku' => 'fuu']),
    new Product(['sku' => 'bar']), new Product(['sku' => 'bar'])]);
$products->limit(2);
if (assert(($products->getSize() == 2), "Return limited size"))
    echo '.';
if (assert(($products->getProducts() == [new Product(['sku' => 'fuu']),
        new Product(['sku' => 'bar'])]), "Return limit Product")
)
    echo '.';

$products = new ProductCollection([new Product(['sku' => 'fuu']),
    new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(0);
if (assert(($products->getProducts() == [new Product(['sku' => 'fuu']),
        new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]), "Return offset"))
    echo '.';

$products = new ProductCollection([new Product(['sku' => 'fuu']),
    new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(1);

if (assert(($products->getProducts() == [new Product(['sku' => 'bar']),
        new Product(['sku' => 'baz'])]), "Return offset(1)"))
    echo '.';

$products = new ProductCollection([new Product(['sku' => 'fuu']),
    new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(2);
if (assert(($products->getProducts() == [ new Product(['sku' => 'baz'])]), "Return offset"))
    echo '.';

$products = new ProductCollection([new Product(['sku' => 'fuu']),
    new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]);
$products->offset(2);
if (assert(($products->getProducts() == [ new Product(['sku' => 'baz'])]), "Return offset"))
    echo '.';

echo "\n";