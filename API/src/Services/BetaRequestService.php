<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;
    use Timetabio\Framework\ValueObjects\EmailAddress;

    class BetaRequestService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function createBetaRequest(EmailAddress $email): array
        {
            return $this->databaseBackend->fetch(
                'INSERT INTO beta_requests (email) VALUES (:email) RETURNING *',
                [
                    'email' => $email
                ]
            );
        }

        public function getBetaRequestByEmail(string $email)
        {
            return $this->databaseBackend->fetch(
                'SELECT * FROM beta_requests WHERE email = :email',
                [
                    'email' => $email
                ]
            );
        }

        public function isApproved(string $email): bool
        {
            return $this->databaseBackend->fetchColumn('SELECT coalesce(approved, FALSE) FROM beta_requests WHERE email = :email', [
                'email' => $email
            ]);
        }
    }
}
