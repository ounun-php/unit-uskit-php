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

namespace ounun\baidu\unit\kit\interfaces;

/**
 * Cache for conf loader, to avoid huge disk I/O
 * You can use php-cache or implement your own cache class
 *
 * Interface CacheInterface
 * @package ounun\baidu\unit\kit\ConfLoader
 */
interface cache
{
    /**
     * @param $key
     * @return string
     */
    public function get($key);

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value);
}
