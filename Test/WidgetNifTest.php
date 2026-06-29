<?php
declare(strict_types=1);

namespace FacturaScripts\Plugins\WidgetNif\Test;

use PHPUnit\Framework\TestCase;

/**
 * Integration tests for WidgetNif.
 *
 * Requires FacturaScripts to be installed (BaseWidget must be available).
 * If FacturaScripts is not present, tests are skipped automatically.
 *
 * To run: install this plugin in a FacturaScripts instance and run PHPUnit from the FS root.
 */
class WidgetNifTest extends TestCase
{
    protected function setUp(): void
    {
        if (!class_exists('FacturaScripts\Core\Lib\Widget\BaseWidget')) {
            $this->markTestSkipped('FacturaScripts not available. Install plugin in FS to run widget tests.');
        }
    }

    public function testProcessFormDataNormalizesNif(): void
    {
        $widget = $this->buildWidget('nif');
        $model = new \stdClass();
        $model->nif = null;

        $request = $this->mockRequest('nif', '12 345 678 z');
        $widget->processFormData($model, $request);

        $this->assertSame('12345678Z', $model->nif);
    }

    public function testProcessFormDataStripsSpacesAndDashes(): void
    {
        $widget = $this->buildWidget('nif');
        $model = new \stdClass();
        $model->nif = null;

        $request = $this->mockRequest('nif', 'X 123-456-7 L');
        $widget->processFormData($model, $request);

        $this->assertSame('X1234567L', $model->nif);
    }

    public function testProcessFormDataEmptyFieldSetsNull(): void
    {
        $widget = $this->buildWidget('nif');
        $model = new \stdClass();
        $model->nif = 'PREVIOUS';

        $request = $this->mockRequest('nif', '');
        $widget->processFormData($model, $request);

        $this->assertNull($model->nif);
    }

    public function testProcessFormDataDoesNotValidate(): void
    {
        // Widget only normalizes — consumer model::test() validates.
        $widget = $this->buildWidget('nif');
        $model = new \stdClass();
        $model->nif = null;

        $request = $this->mockRequest('nif', 'INVALID-JUNK');
        $widget->processFormData($model, $request);

        // Should store normalized value without throwing
        $this->assertSame('INVALIDJUNK', $model->nif);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    private function buildWidget(string $fieldname): \FacturaScripts\Plugins\WidgetNif\Lib\Widget\WidgetNif
    {
        $data = [
            'fieldname' => $fieldname,
            'type'      => 'nif',
            'fieldclick' => '',
            'icon'      => '',
            'onclick'   => '',
            'readonly'  => 'false',
            'tabindex'  => -1,
            'required'  => false,
            'class'     => '',
            'id'        => '',
            'children'  => [],
        ];

        return new \FacturaScripts\Plugins\WidgetNif\Lib\Widget\WidgetNif($data);
    }

    /** @return object */
    private function mockRequest(string $field, string $value): object
    {
        return new class ($field, $value) {
            public object $request;

            public function __construct(string $field, string $value)
            {
                $bag = [$field => $value];
                $this->request = new class ($bag) {
                    public function __construct(private array $data)
                    {
                    }

                    public function get(string $key, mixed $default = null): mixed
                    {
                        return $this->data[$key] ?? $default;
                    }
                };
            }
        };
    }
}
