<?php

namespace Database\Factories;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class FriendFactory extends Factory
{

    protected $model = Friend::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();

        $user_id = $this->faker->randomElement($userIds);
        $friend_id = $this->faker->randomElement($userIds);

        if ($user_id === $friend_id) {
            return $this->definition();
        }

        return [
            'user_id' => $this->faker->randomElement($userIds), // Random existing user
            'friend_id' => $this->faker->randomElement($userIds), // Random existing user
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }

}
