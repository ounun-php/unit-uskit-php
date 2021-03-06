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

use ounun\baidu\unit\kit\logger\factory;
use ounun\baidu\unit\kit\session\file;
use ounun\baidu\unit\kit\session\object;
use ounun\baidu\unit\kit\session\session;
use PHPUnit\Framework\TestCase;

class file_session_test extends TestCase
{

    /**
     * @return session
     * @throws \Exception
     */
    public function testFileSession()
    {
        $logger = factory::getInstance([
            'handler' => 'stream',
            'args' => [
                'php://stderr',
                'critical'
            ]
        ]);
        $session = \ounun\baidu\unit\kit\session\factory::instance([
            'type' => 'file',
            'expire' => 300
        ], $logger, 100);
        $this->assertInstanceOf(file::class, $session);
        return $session;
    }

    /**
     * @depends testFileSession
     * @param file $session
     */
    public function testInitRead(file $session)
    {
        $sessionObject = $session->read();
        $this->assertInstanceOf(object::class, $sessionObject);
    }

    /**
     * @depends testFileSession
     * @param file $session
     */
    public function testWriteSession(file $session)
    {
        $sessionObject = $session->read();
        $sessionObject->setState('test_state');
        $sessionObject->setContext(['test_key' => 'test_value']);
        $session->write();

        $newSessionObject = $session->read();
        $this->assertEquals('test_state', $newSessionObject->getState());
        $this->assertEquals(['test_key' => 'test_value'], $newSessionObject->getContext());
    }

}