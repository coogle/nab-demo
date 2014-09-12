<?php

namespace NAB\Loader;

/**
 * The interface used to indicate an Input Driver
 */
interface LoaderInterface
{
    public function setOptions(array $options);
    public function load();   
}