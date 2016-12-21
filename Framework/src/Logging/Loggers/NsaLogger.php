<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Logging\Loggers
{
    use Timetabio\Framework\Backends\FileBackend;
    use Timetabio\Framework\Logging\Logs\AbstractLog;

    class NsaLogger implements LoggerInterface
    {
        /**
         * @var FileBackend
         */
        private $fileBackend;

        /**
         * @var string
         */
        private $fileName;

        public function __construct(FileBackend $fileBackend, string $fileName)
        {
            $this->fileBackend = $fileBackend;
            $this->fileName = $fileName;
        }

        public function log(AbstractLog $log)
        {
            $this->fileBackend->append(
                $this->fileName,
                '[' . date('d.m.Y H:i:s') . '] ' . $log . PHP_EOL . PHP_EOL
            );
        }

        public function handles(AbstractLog $log): bool
        {
            return true;
        }
    }
}
