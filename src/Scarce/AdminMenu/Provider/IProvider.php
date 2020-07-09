<?php

namespace Scarce\AdminMenu\Provider;

interface IProvider{

    public function create($args);

    public function load($args, $callable);

    public function update($args);

}