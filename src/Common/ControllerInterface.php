<?php

    namespace Common;

    interface ControllerInterface
    {
        public function __construct();

        public function getModule();

        public function getTwigData();
    }
