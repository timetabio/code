<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\API\Services
{
    use Timetabio\API\ValueObjects\Hash;
    use Timetabio\API\ValueObjects\Password;
    use Timetabio\API\ValueObjects\Username;
    use Timetabio\Framework\Backends\PostgresBackend;
    use Timetabio\Framework\ValueObjects\EmailAddress;
    use Timetabio\Framework\ValueObjects\Token;

    class UserService
    {
        /**
         * @var PostgresBackend
         */
        private $databaseBackend;

        public function __construct(PostgresBackend $databaseBackend)
        {
            $this->databaseBackend = $databaseBackend;
        }

        public function getUserById(string $userId)
        {
            return $this->databaseBackend->fetch('SELECT id, username, is_verified, email, name, created, updated FROM users WHERE id = :id', [
                'id' => $userId
            ]);
        }

        public function getUserByEmail(EmailAddress $email)
        {
            return $this->databaseBackend->fetch('SELECT id, username, is_verified, email, name, created, updated FROM users WHERE email = :email', [
                'email' => (string) $email
            ]);
        }

        public function getVerificationToken(string $token)
        {
            return $this->databaseBackend->fetch('SELECT * FROM verification_tokens WHERE token = :token', [
                'token' => $token
            ]);
        }

        public function getVerificationTokenByEmail(string $email)
        {
            return $this->databaseBackend->fetch(
                'SELECT tokens.user_id, tokens.token FROM verification_tokens as tokens
                 JOIN users ON tokens.user_id = users.id
                 WHERE users.email = :email',
                [
                    'email' => $email
                ]
            );
        }

        public function getUserByUsername(string $username)
        {
            return $this->databaseBackend->fetch(
                'SELECT * FROM users WHERE lower(username) = :username',
                [
                    'username' => mb_strtolower($username)
                ]
            );
        }

        public function getProfile(string $username)
        {
            return $this->databaseBackend->fetch(
                'SELECT id, username, is_verified, name FROM users WHERE lower(username) = :username',
                [
                    'username' => mb_strtolower($username)
                ]
            );
        }

        public function getLogin(string $user)
        {
            return $this->databaseBackend->fetch(
                'SELECT id, is_verified, password FROM users 
                 WHERE lower(username) = :username
                    OR email = :email',
                [
                    'email' => $user,
                    'username' => mb_strtolower($user)
                ]
            );
        }

        public function getPassword(string $id)
        {
            return $this->databaseBackend->fetchColumn(
                'SELECT password FROM users 
                 WHERE id = :id',
                [
                    'id' => $id
                ]
            );
        }

        public function getUsername(string $userId): string
        {
            $user = $this->databaseBackend->fetch('SELECT username FROM users WHERE id = :id', [
                'id' => $userId
            ]);

            return $user['username'];
        }

        public function createUser(EmailAddress $email, Username $username, Password $password, Token $token): array
        {
            $username = (string) $username;

            $user = [
                'email' => (string) $email,
                'password' => (string) new Hash($password),
                'username' => $username
            ];

            $inserted = $this->databaseBackend->insert(
                'INSERT INTO users (username, email, password) 
                 VALUES (:username, :email, :password)
                 RETURNING id',
                $user
            );

            $user['id'] = $inserted['id'];

            $this->databaseBackend->insert(
                'INSERT INTO verification_tokens (user_id, token) VALUES (:user_id, :token)',
                [
                    'user_id' => $user['id'],
                    'token' => (string) $token
                ]
            );

            return [
                'id' => $user['id']
            ];
        }

        public function verifyUser(string $userId)
        {
            $this->databaseBackend->beginTransaction();

            $this->databaseBackend->execute('UPDATE users SET is_verified = TRUE WHERE id = :id', [
                'id' => $userId
            ]);

            $this->databaseBackend->execute('DELETE FROM verification_tokens WHERE user_id = :id', [
                'id' => $userId
            ]);

            $this->databaseBackend->commitTransaction();
        }

        public function updateUser(string $userId, array $updates)
        {
            $fields = [];

            foreach ($updates as $field => $_) {
                $fields[] = $field . ' = :' . $field;
            }

            $updates['id'] = $userId;

            $this->databaseBackend->execute('UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id', $updates);
        }
    }
}
