<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Handlers
{
    use Timetabio\Framework\Handlers\PostHandlerInterface;
    use Timetabio\Framework\Models\AbstractModel;
    use Timetabio\Frontend\Commands\WriteSessionCommand;
    use Timetabio\Frontend\Session\Session;

    class PostHandler implements PostHandlerInterface
    {
        /**
         * @var Session
         */
        private $session;

        /**
         * @var WriteSessionCommand
         */
        private $writeSessionCommand;

        public function __construct(Session $session, WriteSessionCommand $writeSessionCommand)
        {
            $this->session = $session;
            $this->writeSessionCommand = $writeSessionCommand;
        }

        public function execute(AbstractModel $model)
        {
            $this->writeSessionCommand->execute($this->session);
        }
    }
}
