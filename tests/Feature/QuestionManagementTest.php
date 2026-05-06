<?php

namespace Tests\Feature;

use App\Models\TestYear;
use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_exam_detail_with_question_section(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $academicYear = TestYear::create(['start_year' => 2026, 'end_year' => 2027, 'is_active' => true]);
        $exam = Exam::create([
            'title' => 'Matematika Dasar',
            'slug' => 'matematika-dasar',
            'description' => 'Subtes matematika',
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHour(),
            'duration' => 60,
            'academic_year_id' => $academicYear->id,
        ]);

        $question = $exam->questions()->create(['question_text' => 'Apa itu bilangan prima?']);

        $response = $this->actingAs($admin)->get(route('exams.show', $exam));

        $response->assertStatus(200);
        $response->assertSee('Daftar Soal');
        $response->assertSee('Apa itu bilangan prima?');
        $response->assertSee('Tambah Soal');
    }

    public function test_admin_can_create_question_for_an_exam(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $academicYear = TestYear::create(['start_year' => 2026, 'end_year' => 2027, 'is_active' => true]);
        $exam = Exam::create([
            'title' => 'Fisika Dasar',
            'slug' => 'fisika-dasar',
            'description' => 'Subtes fisika',
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHour(),
            'duration' => 45,
            'academic_year_id' => $academicYear->id,
        ]);

        $response = $this->actingAs($admin)->post(route('exams.questions.store', $exam), [
            'question_text' => 'Jelaskan hukum Newton pertama.',
        ]);

        $response->assertRedirect(route('exams.show', $exam));
        $this->assertDatabaseHas('questions', ['question_text' => 'Jelaskan hukum Newton pertama.', 'exam_id' => $exam->id]);
    }

    public function test_admin_can_create_and_update_an_option_for_question(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $academicYear = TestYear::create(['start_year' => 2026, 'end_year' => 2027, 'is_active' => true]);
        $exam = Exam::create([
            'title' => 'Bahasa Indonesia',
            'slug' => 'bahasa-indonesia',
            'description' => 'Subtes bahasa',
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHour(),
            'duration' => 30,
            'academic_year_id' => $academicYear->id,
        ]);

        $question = $exam->questions()->create(['question_text' => 'Apa arti kata "literasi"?']);

        $response = $this->actingAs($admin)->post(route('questions.options.store', $question), [
            'option_text' => 'Keterampilan membaca dan menulis',
            'is_correct' => '1',
        ]);

        $response->assertRedirect(route('exams.questions.show', [$exam, $question]));

        $option = Option::where('question_id', $question->id)->first();

        $this->assertNotNull($option);
        $this->assertTrue($option->is_correct);
        $this->assertDatabaseHas('options', [
            'id' => $option->id,
            'option_text' => 'Keterampilan membaca dan menulis',
            'question_id' => $question->id,
            'is_correct' => true,
        ]);

        $response = $this->actingAs($admin)->put(route('options.update', $option), [
            'option_text' => 'Kemampuan membaca dan menulis',
        ]);

        $response->assertRedirect(route('exams.questions.show', [$exam, $question]));
        $this->assertDatabaseHas('options', [
            'id' => $option->id,
            'option_text' => 'Kemampuan membaca dan menulis',
            'is_correct' => false,
        ]);
    }
}
