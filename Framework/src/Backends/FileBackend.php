<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Framework\Backends
{
    class FileBackend
    {
        public function read(string $file): string
        {
            if (!$this->exists($file)) {
                throw new \Exception('file ' . $file . ' not found');
            }

            return file_get_contents($file);
        }

        public function write(string $fileName, string $content)
        {
            try {
                file_put_contents($fileName, $content);
            } catch (\Throwable $error) {
                throw new \Exception('could not write to file ' . $fileName, 0, $error);
            }
        }

        public function append(string $fileName, string $content)
        {
            try {
                file_put_contents($fileName, $content, FILE_APPEND);
            } catch (\Throwable $error) {
                throw new \Exception('could not write to file ' . $fileName, 0, $error);
            }
        }

        public function exists(string $file): bool
        {
            return file_exists($file);
        }
    }
}
