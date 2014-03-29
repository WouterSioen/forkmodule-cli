<?php

namespace Forkmodule;

/**
 * Forkcontroller class
 */
class Forkcontroller
{
    /**
     * @var \Pimple
     */
    protected $app;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $safeName;



    /**
     * Constructor Method
     *
     * @param \Pimple   $app    The app container
     * @param string    $name   The action name
     */
    public function __construct($app, $name)
    {
        // Assign
        $this->app = $app;
        $this->name = (string) $name;

        // Create a safe action name
        $this->safeName = (string) new SafeName($this->name);
    }
}
