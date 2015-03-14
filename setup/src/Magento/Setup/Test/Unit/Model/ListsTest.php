<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Test\Unit\Model;

use \Magento\Setup\Model\Lists;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class ListsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Lists
     */
    protected $lists;

    /**
     * @var  \PHPUnit_Framework_MockObject_MockObject | \Magento\Framework\Locale\ConfigInterface
     */
    protected $mockConfig;

    /**
     * @var array
     */
    protected $expectedTimezones = [
        'Australia/Darwin',
        'America/Los_Angeles',
        'Europe/Kiev',
        'Asia/Jerusalem',
    ];

    /**
     * @var array
     */
    protected $expectedCurrencies = [
        'USD',
        'EUR',
        'UAH',
        'GBP',
    ];

    /**
     * @var array
     */
    protected $expectedLocales = [
        'en_US',
        'en_GB',
        'uk_UA',
        'de_DE',
    ];

    public function setUp()
    {
        $this->mockConfig = $this->getMockBuilder('\Magento\Framework\Locale\ConfigInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $this->mockConfig->expects($this->any())
            ->method('getAllowedLocales')
            ->willReturn($this->expectedLocales);

        $this->lists = new Lists($this->mockConfig);
    }

    public function testGetTimezoneList()
    {
        $timezones = array_intersect($this->expectedTimezones, array_keys($this->lists->getTimezoneList()));
        $this->assertEquals($this->expectedTimezones, $timezones);
    }

    public function testGetCurrencyList()
    {
        $currencies = array_intersect($this->expectedCurrencies, array_keys($this->lists->getCurrencyList()));
        $this->assertEquals($this->expectedCurrencies, $currencies);
    }

    public function testGetLocaleList()
    {
        $locales = array_intersect($this->expectedLocales, array_keys($this->lists->getLocaleList()));
        $this->assertEquals($this->expectedLocales, $locales);
    }
}
