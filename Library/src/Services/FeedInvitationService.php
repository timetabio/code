<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Library\Services
{
    use Timetabio\Framework\Backends\PostgresBackend;
    use Timetabio\Library\DataObjects\FeedInvitation;
    use Timetabio\Library\UserRoles\UserRole;

    class FeedInvitationService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function getInvitations(string $feedId): array
        {
            return $this->databaseBackend->fetchAll(
                'SELECT invitation.*, users.name, users.username
                 FROM feed_invitations AS invitation
                 JOIN users ON invitation.user_id = users.id
                 WHERE invitation.feed_id = :feed_id
                 ORDER BY invitation.created DESC',
                [
                    'feed_id' => $feedId
                ]
            );
        }

        public function getInvitation(string $feedId, string $userId)
        {
            return $this->databaseBackend->fetch(
                'SELECT * FROM feed_invitations
                 WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );
        }

        public function hasInvitation(string $feedId, string $userId): bool
        {
            $result = $this->databaseBackend->fetch(
                'SELECT 1 FROM feed_invitations
                 WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );

            return ($result !== null);
        }

        public function createInvitation(FeedInvitation $invitation): array
        {
            return $this->databaseBackend->fetch(
                'INSERT INTO feed_invitations (feed_id, user_id, role)
                 VALUES (:feed_id, :user_id, :role)
                 RETURNING *',
                [
                    'feed_id' => $invitation->getFeedId(),
                    'user_id' => $invitation->getUserId(),
                    'role' => (string) $invitation->getUserRole()
                ]
            );
        }

        public function deleteInvitation(string $feedId, string $userId)
        {
            $this->databaseBackend->execute(
                'DELETE FROM feed_invitations
                 WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );
        }

        public function updateInvitation(string $feedId, string $userId, UserRole $userRole)
        {
            $this->databaseBackend->execute(
                'UPDATE feed_invitations
                 SET role = :role
                 WHERE feed_id = :feed_id AND user_id = :user_id',
                [
                    'role' => (string) $userRole,
                    'feed_id' => $feedId,
                    'user_id' => $userId
                ]
            );
        }
    }
}
