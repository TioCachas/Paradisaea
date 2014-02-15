<?php

App::uses('Configuration', 'Model');

class Bosch {

    private $configuration;

    public function setConfiguration(Configuration $configuration) {
        $this->configuration = $configuration;
    }

    public function getConfiguration() {
        return $this->configuration;
    }

}
