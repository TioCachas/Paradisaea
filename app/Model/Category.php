<?php

App::uses('AppModel', 'Model');

class Category extends AppModel {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $useTable = 'categories';

}
