<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_ability_to_create_user(): void
    {
        $user = User::factory(1)->create()->first();
        $this->assertDatabaseCount('users', 1);

        $userAsArray = $user->toArray();
        $userAsArray['updated_at'] = Carbon::parse($userAsArray['updated_at'])->toIso8601String();
        $userAsArray['created_at'] = Carbon::parse($userAsArray['created_at'])->toIso8601String();

        $this->assertDatabaseHas('users', $userAsArray);
    }

    public function test_ability_to_delete_user(): void
    {
        User::create([
            'first_name' => 'abdalhalem',
            'last_name' => 'alfakhrany',
            'email' => 'abdalhalem@app.com',
            'password' => Hash::make('password'),
        ]);

        $this->assertDatabaseCount('users', 1);

        $user = User::find(1);
        $user->delete($user);

        $this->assertDatabaseEmpty('users');
    }

    public function test_ability_to_update_user(): void
    {
        $password = Hash::make('password');

        User::create([
            'first_name' => 'abdalhalem',
            'last_name' => 'alfakhrany',
            'email' => 'abdalhalem@app.com',
            'password' => $password,
        ]);

        $this->assertDatabaseHas('users', [
            'first_name' => 'abdalhalem',
            'last_name' => 'alfakhrany',
            'email' => 'abdalhalem@app.com',
            'password' => $password,
            'image_id' => null
        ]);

        $user = User::find(1);
        $user->first_name = 'mohamed';
        $user->save();

        $this->assertDatabaseHas('users', [
            'first_name' => 'mohamed',
            'last_name' => 'alfakhrany',
            'email' => 'abdalhalem@app.com',
            'password' => $password,
            'image_id' => null
        ]);
    }
    public function test_ability_to_read_user(): void
    {
        $password = Hash::make('password');

        User::create([
            'first_name' => 'abdalhalem',
            'last_name' => 'alfakhrany',
            'email' => 'abdalhalem@app.com',
            'password' => $password,
        ]);

        $data = [
            'id' => 1,
            'first_name' => 'abdalhalem',
            'last_name' => 'alfakhrany',
            'email' => 'abdalhalem@app.com',
            'image_id' => null,
        ];

        $user = User::find(1)->get([
            'id',
            'first_name',
            'last_name',
            'email',
            'image_id'
        ])->first();

        $this->assertEquals($data, $user->toArray());
    }
    public function test_ability_to_list_users(): void
    {
        $usersFromFactory = User::factory(10)->create();
        $this->assertDatabaseCount('users', 10);
        $usersFromQuery = User::all();
        $this->assertEquals($usersFromFactory->toArray(), $usersFromQuery->toArray());
    }
}
