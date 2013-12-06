<?php
namespace Test\Model;

use \App\Model\Customer;

class CustomerTest extends \PHPUnit_Framework_TestCase
{

    public function testSavesDataInResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');

        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Sasha']));

        $customer = new Customer(['name' => 'Sasha']);
        $customer->save($resource);
    }

    public function testGetsIdFromResourceAfterSave()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('save')
            ->with($this->equalTo(['name' => 'Sasha']))
            ->will($this->returnValue(42));

        $customer = new Customer(['name' => 'Sasha']);
        $customer->save($resource);
        $this->assertEquals(42, $customer->getId());
    }

    public function testReturnIdWhichHasBeenInitialized()
    {
        $customer = new Customer(['customer_id' => 1]);
        $this->assertEquals(1, $customer->getId());

        $customer = new Customer(['customer_id' => 2]);
        $this->assertEquals(2, $customer->getId());
    }

}