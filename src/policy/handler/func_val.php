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



class func_val extends handler
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $function = explode(':', $this->value);
        $params   = explode(',', $function[1]);
        foreach ($params as $index => $param) {
            $params[$index] = $this->policy->params_replace($param);
        }

        if (!method_exists($this->policy->manager->service_get(), $function[0])) {
            throw new \Exception("Function '$function[0]' not found in " . get_class($this->policy->manager->service_get()));
        }
        return call_user_func_array(array($this->policy->manager->service_get(), $function[0]), $params);
    }
}