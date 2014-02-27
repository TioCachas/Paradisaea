<?php

App::uses('ConfigCapture', 'Model');

class Bosch {

    private $configuration;

    public function setConfiguration(ConfigCapture $configuration) {
        $this->configuration = $configuration;
    }

    public function getConfiguration() {
        return $this->configuration;
    }

}
