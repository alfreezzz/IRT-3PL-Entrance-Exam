<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

class EditorComponentTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_component_pushes_styles_and_scripts_into_stacks(): void
    {
        View::share('errors', new ViewErrorBag);

        $html = Blade::render(
            '@stack("styles")<x-form.editor name="question_text" :value="$value" />@stack("scripts")',
            [
                'value' => '<p>Contoh isi editor</p>',
            ]
        );

        $this->assertStringContainsString('quill_question_text', $html);
        $this->assertStringContainsString('dispatchEvent(new Event(\'input\'))', $html);
        $this->assertStringContainsString('ql-toolbar', $html);
    }
}
