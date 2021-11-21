<?php

namespace Fhp\Model\TanRequestChallengeFlicker;

use Fhp\Syntax\Bin;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TanRequestChallengeFlickerTest extends TestCase
{
    const OLD_VERSION = '11 04 871 49552 05 123456789F 14 302C3031 07';
    const BESTAND_ABFRAGEN_IN1 = '038 8A 01 2392302069 22 DE12500105170648489890'; // example iban
    const BESTAND_ABFRAGEN_IN2 = '038 8A 01 2392307899 22 DE12500105170648489890'; // example iban
    const BESTAND_ABFRAGEN_OUT1 = '1f8501239230206956444531323530303130353137303634383438393839305e';
    const BESTAND_ABFRAGEN_OUT2 = '1f8501239230789956444531323530303130353137303634383438393839300c';

    public function testGetHex1(): void
    {
        $flicker = new TanRequestChallengeFlicker(new Bin(self::BESTAND_ABFRAGEN_IN1));
        $this->assertEquals(self::BESTAND_ABFRAGEN_OUT1, $flicker->getHex());
    }

    public function testGetHex2(): void
    {
        $flicker = new TanRequestChallengeFlicker(new Bin(self::BESTAND_ABFRAGEN_IN2));
        $this->assertEquals(self::BESTAND_ABFRAGEN_OUT2, $flicker->getHex());
    }

    public function testGetHexOldVersion(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $flicker = new TanRequestChallengeFlicker(new Bin(self::OLD_VERSION));
    }
}
