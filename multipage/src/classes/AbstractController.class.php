<?php

use Silex\Application;

abstract class AbstractController
{
    /**
     * @var Application;
     */
    protected $app = null;

    /**
     * @param Application $app
     */
    public function setContainer(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function addData($name, $value)
    {
        $dataIndex = get_class($this).'.data';
        if(!isset($this->app[$dataIndex])) {
            $this->app[$dataIndex] = array(
                $name => $value
            );
        }
        else {
            $data = $this->app[$dataIndex];
            $data[$name] = $value;
            $this->app[$dataIndex] = $data;
        }
    }
}

