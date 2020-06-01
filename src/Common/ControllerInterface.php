<?php

    namespace Common;

    interface ControllerInterface
    {
        public function __construct(array $args);

        public function getModule();

        public function getTwigData();
    }
