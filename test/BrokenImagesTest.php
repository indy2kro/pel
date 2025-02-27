<?php

declare(strict_types=1);

namespace Pel\Test;

use lsolesen\pel\PelIllegalFormatException;
use lsolesen\pel\PelJpeg;
use PHPUnit\Framework\TestCase;

class BrokenImagesTest extends TestCase
{
    public function testWindowWindowExceptionIsCaught(): void
    {
        $jpeg = new PelJpeg(__DIR__ . '/broken_images/gh-10-a.jpg');
        $this->assertNotSame('', $jpeg->getBytes());
    }

    public function testWindowOffsetExceptionIsCaught(): void
    {
        $jpeg = new PelJpeg(__DIR__ . '/broken_images/gh-10-b.jpg');
        $this->assertNotSame('', $jpeg->getBytes());
    }

    public function testParsingNotFailingOnRecursingIfd(): void
    {
        $jpeg = new PelJpeg(__DIR__ . '/broken_images/gh-11.jpg');
        $this->assertNotSame('', $jpeg->getBytes());
    }

    public function testInvalidIfd(): void
    {
        $this->expectException(PelIllegalFormatException::class);
        $jpeg = new PelJpeg(__DIR__ . '/broken_images/gh-156.jpg');
        $this->assertNotSame('', $jpeg->getBytes());
    }
}
