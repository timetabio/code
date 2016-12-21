<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio\Frontend\Models
{
    use Timetabio\Framework\Http\Redirect\RedirectInterface;
    use Timetabio\Framework\Http\StatusCodes\StatusCodeInterface;
    use Timetabio\Frontend\DataObjects\User;

    class FrontendModel extends \Timetabio\Framework\Models\AbstractModel
    {
        /**
         * @var StatusCodeInterface
         */
        private $statusCode;

        /**
         * @var RedirectInterface
         */
        private $redirect;

        /**
         * @var string
         */
        private $crfsToken;

        /**
         * @var User
         */
        private $user;

        public function getStatusCode(): StatusCodeInterface
        {
            return $this->statusCode;
        }

        public function hasStatusCode(): bool
        {
            return $this->statusCode !== null;
        }

        public function setStatusCode(StatusCodeInterface $statusCode)
        {
            $this->statusCode = $statusCode;
        }

        public function getRedirect(): RedirectInterface
        {
            return $this->redirect;
        }

        public function hasRedirect(): bool
        {
            return $this->redirect !== null;
        }

        public function setRedirect(RedirectInterface $redirect)
        {
            $this->redirect = $redirect;
        }

        public function getCrfsToken(): string
        {
            return $this->crfsToken;
        }

        public function setCrfsToken(string $crfsToken)
        {
            $this->crfsToken = $crfsToken;
        }

        public function getUser(): User
        {
            return $this->user;
        }

        public function hasUser(): bool
        {
            return $this->user !== null;
        }

        public function setUser(User $user)
        {
            $this->user = $user;
        }
    }
}
