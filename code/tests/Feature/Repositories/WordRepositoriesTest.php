<?php
namespace Tests\Feature\Repositories;

use App\Models\Word;
use Tests\TestCase;
use App\Repositories\WordRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Depends;

class WordRepositoriesTest extends TestCase
{
    use RefreshDatabase;

    protected $wordRepository;
    protected $defaultUser;
    protected $wordData;
    protected $word;

    protected function setUp(): void
    {
        parent::setUp();
        $this->wordRepository = $this->app->make(WordRepository::class);
        $this->defaultUser = $this->getDefaultUser();
        $this->wordData = [
            'word' => 'example',
            'creator_id' => $this->defaultUser->id,
        ];
        $this->word = $this->wordRepository->create($this->wordData);
    }

    public function test_it_can_create_a_word()
    {
        $this->assertDatabaseHas('words', ['word' => 'example']);
        $this->assertEquals('example', $this->word->word);
    }

    #[Depends('test_it_can_create_a_word')]
    public function test_it_can_find_a_word_by_id()
    {
        $foundWord = $this->wordRepository->findById($this->word->id);

        $this->assertEquals($this->word->id, $foundWord->id);
    }

    #[Depends('test_it_can_create_a_word')]
    public function test_it_can_save_a_word()
    {
        $this->word->word = $this->faker->word;
        $this->wordRepository->save($this->word);

        $this->assertDatabaseHas(
            'words',
            [
                'word' => $this->word->word,
                'id' => $this->word->id
            ]
        );
    }

    public function test_it_can_delete_a_word_by_id()
    {
        $this->wordRepository->delete($this->word->id);

        $this->assertDatabaseMissing('words', ['id' => $this->word->id]);
    }

    public function test_it_can_delete_a_word_by_instance()
    {
        $this->wordRepository->delete($this->word);

        $this->assertDatabaseMissing('words', ['id' => $this->word->id]);
    }

    public function test_it_cant_delete_non_int_or_model_instances()
    {
        $this->assertFalse($this->wordRepository->delete('string'));
    }

    public function test_it_can_get_all()
    {
        $wordCount = random_int(2, 10);
        Word::factory()->count($wordCount)->create();
        $this->assertEquals($wordCount + 1, $this->wordRepository->getAll()->count());
    }

    public function test_it_assign_correctly_model()
    {
        $wordRepository = new WordRepository(new Word());
        $this->assertTrue($wordRepository->getModel() instanceof Word);
    }

    public function test_it_can_find_by_word_value()
    {
        $words = Word::factory(5)->create();
        $wordRandom = $this->faker->randomElement($words);
        $this->assertEquals(
            $wordRandom->word,
            $this->wordRepository->findByWordValue($wordRandom->word)->word
        );
    }

    public function test_it_can_update_word_by_id()
    {
        $newWord = $this->faker->word;
        $this->wordRepository->update($this->word->id, ['word' => $newWord]);

        $this->assertDatabaseHas('words', ['id' => $this->word->id, 'word' => $newWord]);
        $this->assertNull($this->wordRepository->update(999, ['word' => $newWord]));
    }
}
