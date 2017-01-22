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
    use Ink\Generators\Dom\Generator;
    use Ink\Parser;
    use Timetabio\Framework\ValueObjects\InkResult;

    class InkBackend
    {
        /**
         * @var Parser
         */
        private $parser;

        /**
         * @var Generator
         */
        private $generator;

        /**
         * @var \Ink\Generators\Text\Generator
         */
        private $textGenerator;

        public function __construct(
            Parser $parser,
            Generator $generator,
            \Ink\Generators\Text\Generator $textGenerator
        )
        {
            $this->parser = $parser;
            $this->generator = $generator;
            $this->textGenerator = $textGenerator;
        }

        public function process(string $text): InkResult
        {
            $ast = $this->parser->parse(str_replace("\r\n", PHP_EOL, $text));

            return new InkResult(
                $this->generator->generate($ast),
                $this->textGenerator->generate($ast)
            );
        }
    }
}
