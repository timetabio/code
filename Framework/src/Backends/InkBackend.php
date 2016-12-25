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
    use Ink\Transformations\PreviewTransformation;
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

        /**
         * @var PreviewTransformation
         */
        private $previewTransformation;

        public function __construct(
            Parser $parser,
            Generator $generator,
            PreviewTransformation $previewTransformation,
            \Ink\Generators\Text\Generator $textGenerator
        )
        {
            $this->parser = $parser;
            $this->generator = $generator;
            $this->textGenerator = $textGenerator;
            $this->previewTransformation = $previewTransformation;
        }

        public function process(string $text): InkResult
        {
            $ast = $this->parser->parse(str_replace("\r\n", PHP_EOL, $text));

            return new InkResult(
                $this->generator->generate($ast),
                $this->generator->generate($this->previewTransformation->apply($ast)),
                $this->textGenerator->generate($ast)
            );
        }
    }
}
