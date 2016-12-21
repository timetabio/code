<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Worker\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;

    class FileService
    {
        /**
         * @var PostgresBackend
         */
        private $postgresBackend;

        public function __construct(PostgresBackend $postgresBackend)
        {
            $this->postgresBackend = $postgresBackend;
        }

        public function getUnusedFiles(int $limit): array
        {
            return $this->postgresBackend->fetchAll(
                'SELECT files.* FROM files
                 LEFT JOIN post_attachments ON post_attachments.file_id = files.id
                 WHERE  post_attachments.id IS NULL
                   AND files.created < (utc_now() - INTERVAL \'24 hours\')
                 LIMIT :limit',
                [
                    'limit' => $limit
                ]
            );
        }

        public function deleteFile(string $fileId)
        {
            $this->postgresBackend->execute('DELETE FROM files WHERE id = :id', [
                'id' => $fileId
            ]);
        }
    }
}
