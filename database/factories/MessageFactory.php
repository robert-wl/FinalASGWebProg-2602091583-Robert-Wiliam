<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class MessageFactory extends Factory
{

    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();

        $sender_id = $this->faker->randomElement($userIds);

        $friends = User::find($sender_id)->friends()->where('status', 'accepted')->pluck('friend_id')->toArray();
        $receiver_id = $this->faker->randomElement($friends);

        if ($sender_id === $receiver_id) {
            return $this->definition();
        }
        

        return [
            'sender_id' => $this->faker->randomElement($userIds),
            'receiver_id' => $this->faker->randomElement($userIds),
            'message' => $this->faker->sentence,
            'read' => $this->faker->boolean,
        ];
    }

}
