<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/ProductCollection.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/ReviewCollection.php';
class ProductController
{
    public function listAction()
    {
        $products = new ProductCollection([
            new Product ([
                'sku' => '12345',
                'name' => 'NokiodDX',
                'image' => 'http://www.potofthots.com/wp-content/uploads/2012/04/Nokia-3310-02.jpg',
                'price' => 1113.5,
                'special_price' => 42
            ]),
            new Product ([
                'sku' => '12333',
                'name' => 'Nokiobb',
                'image' => 'http://www.potofthots.com/wp-content/uploads/2012/04/Nokia-3310-02.jpg',
                'price' => 1123.5
            ]),
            new Product ([
                'sku' => '55w213',
                'name' => 'Nokioww',
                'image' => 'http://www.potofthots.com/wp-content/uploads/2012/04/Nokia-3310-02.jpg',
                'price' => 143.5,
                'special_price' => 42
            ]),
            new Product ([
                'sku' => '12366',
                'name' => 'Nokioee',
                'image' => 'http://www.potofthots.com/wp-content/uploads/2012/04/Nokia-3310-02.jpg',
                'price' => 123.5
            ]),
            new Product ([
                'sku' => '664423',
                'name' => 'Nokioy',
                'image' => 'http://www.potofthots.com/wp-content/uploads/2012/04/Nokia-3310-02.jpg',
                'price' => 1836.5
            ])
        ]);

        require_once __DIR__ . "/../views/product_list.phtml";
    }

    public function viewAction()
    {
        $product = new Product ([
            'sku' => '12345',
            'name' => 'NokiodDX',
            'image' => 'http://www.potofthots.com/wp-content/uploads/2012/04/Nokia-3310-02.jpg',
            'price' => 1113.5,
            'special_price' => 42
        ]);

        require_once __DIR__ . "/../views/product_view.phtml";
    }

}