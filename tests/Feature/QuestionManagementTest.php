<?php

namespace Tests\Feature;

use App\Models\Exam;
use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_exam_detail_with_question_section(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $subtestId = DB::table('subtests')->insertGetId([
            'name' => 'Matematika',
            'slug' => 'matematika',
            'description' => 'Subtes Matematika',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $exam = Exam::create([
            'subtest_id' => $subtestId,
            'title' => 'Matematika Dasar',
            'slug' => 'matematika-dasar',
            'description' => 'Subtes matematika',
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHour(),
            'duration' => 60,
            'year' => 2026,
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
        $subtestId = DB::table('subtests')->insertGetId([
            'name' => 'Fisika',
            'slug' => 'fisika',
            'description' => 'Subtes Fisika',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $exam = Exam::create([
            'subtest_id' => $subtestId,
            'title' => 'Fisika Dasar',
            'slug' => 'fisika-dasar',
            'description' => 'Subtes fisika',
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHour(),
            'duration' => 45,
            'year' => 2026,
        ]);

        $response = $this->actingAs($admin)->post(route('exams.questions.store', $exam), [
            'question_text' => 'Jelaskan hukum Newton pertama.',
            'question_type' => 'short_answer',
        ]);

        $response->assertRedirect(route('exams.show', $exam));
        $this->assertDatabaseHas('questions', ['question_text' => 'Jelaskan hukum Newton pertama.', 'exam_id' => $exam->id]);
    }

    public function test_admin_can_create_and_update_an_option_for_question(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $subtestId = DB::table('subtests')->insertGetId([
            'name' => 'Bahasa Indonesia',
            'slug' => 'bahasa-indonesia',
            'description' => 'Subtes Bahasa Indonesia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $exam = Exam::create([
            'subtest_id' => $subtestId,
            'title' => 'Bahasa Indonesia',
            'slug' => 'bahasa-indonesia',
            'description' => 'Subtes bahasa',
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHour(),
            'duration' => 30,
            'year' => 2026,
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

    public function test_admin_can_create_and_update_true_false_table_question(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $subtestId = DB::table('subtests')->insertGetId([
            'name' => 'Biologi',
            'slug' => 'biologi',
            'description' => 'Subtes Biologi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $exam = Exam::create([
            'subtest_id' => $subtestId,
            'title' => 'Biologi Dasar',
            'slug' => 'biologi-dasar',
            'description' => 'Subtes biologi',
            'start_time' => now()->addDay(),
            'end_time' => now()->addDay()->addHour(),
            'duration' => 45,
            'year' => 2026,
        ]);

        $statements = [
            [
                'statement_text' => 'Sel adalah unit terkecil dari kehidupan',
                'correct_value' => 1, // true
            ],
            [
                'statement_text' => 'Mitochondria adalah organel yang menghasilkan energi',
                'correct_value' => 1, // true
            ],
            [
                'statement_text' => 'DNA terdapat di dalam nukleus sel',
                'correct_value' => 1, // true
            ],
            [
                'statement_text' => 'Tanaman tidak membutuhkan air untuk fotosintesis',
                'correct_value' => 0, // false
            ],
        ];

        $response = $this->actingAs($admin)->post(route('exams.questions.store', $exam), [
            'question_text' => 'Tentukan pernyataan mana yang benar dan salah tentang biologi sel.',
            'question_type' => 'true_false_table',
            'statements' => $statements,
        ]);

        $response->assertRedirect(route('exams.show', $exam));

        $question = $exam->questions()->where('question_type', 'true_false_table')->first();
        $this->assertNotNull($question);
        $this->assertEquals('true_false_table', $question->question_type);
        $this->assertCount(4, $question->statements);

        // Check specific statements
        $statement1 = $question->statements()->where('order', 1)->first();
        $this->assertEquals('Sel adalah unit terkecil dari kehidupan', $statement1->statement_text);
        $this->assertTrue($statement1->correct_value);

        $statement4 = $question->statements()->where('order', 4)->first();
        $this->assertEquals('Tanaman tidak membutuhkan air untuk fotosintesis', $statement4->statement_text);
        $this->assertFalse($statement4->correct_value);
    }
}
