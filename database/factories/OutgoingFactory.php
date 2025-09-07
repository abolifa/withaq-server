<?php

namespace Database\Factories;

use App\Models\Outgoing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Outgoing>
 */
class OutgoingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => null,
            'issue_number' => $this->faker->unique()->numerify('OUT-#####'),
            'issue_date' => $this->faker->date(),
            'qr_code' => null,
            'to_contact_id' => null,
            'template_id' => null,
            'to' => $this->faker->email(),
            'subject' => $this->faker->sentence(),
            'cc' => json_encode([$this->faker->email(), $this->faker->email()]),
            'body' => $this->faker->paragraphs(3, true),
            'attachments' => json_encode([]),
            'document_path' => null,
        ];
    }
}
