<?php

class BaseController extends Controller
{
    /**
     * @var Logger
     */
    private $logger;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    /**
     * Custom logger
     *
     * @param string $name Name of the logger-file
     *
     * @return Logger|\Monolog\Logger
     */
    protected function getLog($name = 'event')
    {
        if ($this->logger)
            return $this->logger;

        $logger = new \Monolog\Logger('Event Logger');
        $logger->pushHandler(
            new \Monolog\Handler\StreamHandler(
                storage_path() . "/logs/{$name}.log", \Monolog\Logger::INFO
            )
        );

        $this->logger = $logger;
        return $logger;
    }

}