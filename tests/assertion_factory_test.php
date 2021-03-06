<?php
// Copyright (c) 2018 Baidu, Inc. All Rights Reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
namespace tests;

use ounun\baidu\unit\kit\policy\output\assertion\assertion;
use ounun\baidu\unit\kit\policy\output\assertion\factory;
use PHPUnit\Framework\TestCase;

class assertion_factory_test extends TestCase
{
    /** @throws \Exception  */
    public function testAssertionFactoryByType()
    {
        $assertion = factory::getInstance('eq');
        $this->assertInstanceOf(assertion::class, $assertion);
    }

    /** @throws \Exception  */
    public function testEqAssertion()
    {
        $assertion = factory::getInstance('eq');
        $this->assertTrue($assertion->assert('1,1'));
    }

    /** @throws \Exception  */
    public function testCustomAssertion()
    {
        $assertion = factory::getInstance(TestAssertion::class);
        $this->assertInstanceOf(TestAssertion::class, $assertion);
        $this->assertTrue($assertion->assert(null));
    }
}