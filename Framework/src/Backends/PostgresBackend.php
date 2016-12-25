<?php
/**
 * Copyright (c) 2016 Ruben Schmidmeister <ruben.schmidmeister@icloud.com>
 *
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the GNU Affero General Public License,
 * version 3, as published by the Free Software Foundation.
 */
namespace Timetabio\Framework\Backends
{
    class PostgresBackend
    {
        /**
         * @var \PDO
         */
        private $pdo;

        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function fetch(string $sql, array $parameters = [])
        {
            $stmt = $this->executeStatement($sql, $parameters);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result === false) {
                return null;
            }

            return $result;
        }

        public function fetchAll(string $sql, array $parameters = [])
        {
            $stmt = $this->executeStatement($sql, $parameters);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function fetchColumn(string $sql, array $parameters = [])
        {
            $stmt = $this->executeStatement($sql, $parameters);

            return $stmt->fetch(\PDO::FETCH_COLUMN);
        }

        public function fetchColumns(string $sql, array $parameters = []): \Traversable
        {
            $stmt = $this->executeStatement($sql, $parameters);

            $stmt->setFetchMode(\PDO::FETCH_COLUMN, 0);

            return $stmt;
        }

        public function insert(string $sql, array $parameters = [])
        {
            return $this->fetch($sql, $parameters);
        }

        public function execute(string $sql, array $parameters = [])
        {
            $this->executeStatement($sql, $parameters);
        }

        public function lastInsertId(string $name)
        {
            return $this->pdo->lastInsertId($name);
        }

        public function beginTransaction()
        {
            $this->pdo->beginTransaction();
        }

        public function commitTransaction()
        {
            $this->pdo->commit();
        }

        public function rollbackTransaction()
        {
            $this->pdo->rollBack();
        }

        private function executeStatement(string $sql, array $parameters): \PDOStatement
        {
            $statement = $this->pdo->prepare($sql);

            foreach ($parameters as $key => $value) {
                if ($value instanceof \Timetabio\Framework\Pdo\Value\ValueInterface) {
                    $statement->bindValue($key, $value->getValue(), $value->getType());
                } else {
                    $statement->bindValue($key, $value);
                }
            }

            try {
                $statement->execute();
            } catch (\Exception $exception) {
                // Ignore invalid_text_representation (See: https://www.postgresql.org/docs/9.4/static/errcodes-appendix.html)
                // TODO: this might be dangerous for inserts with UUIDs or Enums
                if ($exception->getCode() !== '22P02') {
                    throw $exception;
                }
            }

            return $statement;
        }
    }
}
