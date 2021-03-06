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

namespace ounun\baidu\unit\kit\policy\handler;

use GuzzleHttp\Client;

class http_request extends handler
{
    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function handle()
    {
        $client = new Client();
        $method = $this->options['method'] ?? 'get';

        $requestOptions = [];
        foreach ($this->options as $key => $option) {
            $requestOptions[$key] = $this->policy->params_replace($option);
        }

        $res = $client->request($method, $this->value, $requestOptions);
        return [
            'http_code' => $res->getStatusCode(),
            'body' => json_decode((string)$res->getBody(), true)
        ];
    }
}