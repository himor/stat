<?php

/**
 * Class IndexController
 * @author Mike Gordo <mgordo@live.com>
 */
class IndexController extends BaseController {

    public function showIndex()
    {
        return View::make('index.display');
    }

}
