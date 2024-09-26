<?php

use App\Enums\RoleEnum;
use App\Models\User;

test('should list all users', function () {
    $users = User::factory()->count(10)->create();

    $this->get(route('users.index'))
        ->assertStatus(200)
        ->assertSee($users->first()->name)
        ->assertSee($users->last()->name);
});

test('can show a user', function () {
    $user = User::factory()->create();

    $this->get(route('users.show', $user->id))
        ->assertStatus(200)
        ->assertSee($user->name)
        ->assertSee($user->email)
        ->assertSee($user->role->name);
});

it('store user screen can be rendered', function () {
    $this->get(route('users.create'))
        ->assertStatus(200)
        ->assertSee('Criar usuário');
});

test('store name is required', function () {
    $data = [
        'email' => 'user@test.com',
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('name');
});

test('store name is too long', function () {
    $data = [
        'name' => str_repeat('a', 256),
        'email' => 'user@test.com',
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('name');
});

test('store email is required', function () {
    $data = [
        'name' => 'User Test name',
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('email');
});

test('store email is invalid', function () {
    $data = [
        'name' => 'User Test name',
        'email' => 'user',
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('email');
});

test('store email is too long', function () {
    $data = [
        'name' => 'User Test name',
        'email' => str_repeat('a', 256),
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('email');
});

test('store email is unique', function () {
    $user = User::factory()->create();

    $data = [
        'name' => 'User Test name',
        'email' => $user->email,
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('email');
});

test('store role is required', function () {
    $data = [
        'name' => 'User Test name',
        'email' => 'user@test.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('role');
});

test('store password is required', function () {
    $data = [
        'name' => 'User Test name',
        'email' => 'user@test.com',
        'role' => RoleEnum::Admin->value,
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('password');
});

test('store password is too short', function () {
    $data = [
        'name' => 'User Test name',
        'email' => 'user@test.com',
        'role' => RoleEnum::Admin->value,
        'password' => '123',
        'password_confirmation' => '123',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('password');
});

test('store password confirmation is invalid', function () {
    $data = [
        'name' => 'User Test name',
        'email' => 'user@test.com',
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password1234',
    ];

    $this->post(route('users.store'), $data)
        ->assertSessionHasErrors('password');
});

test('can store a user', function () {
    $data = [
        'name' => 'User Test name',
        'email' => 'user@test.com',
        'role' => RoleEnum::Admin->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->post(route('users.store'), $data)
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'email' => 'user@test.com',
        'name' => 'User Test name',
    ]);
});

test('edit name is required', function () {
    $user = User::factory()->create();

    $data = [
        'email' => $user->email,
        'role' => $user->role->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertSessionHasErrors('name');
});

test('edit name is too long', function () {
    $user = User::factory()->create();

    $data = [
        'name' => str_repeat('a', 256),
        'email' => $user->email,
        'role' => $user->role->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertSessionHasErrors('name');
});

test('edit email is required', function () {
    $user = User::factory()->create();

    $data = [
        'name' => $user->name,
        'role' => $user->role->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertSessionHasErrors('email');
});

test('edit email is invalid', function () {
    $user = User::factory()->create();

    $data = [
        'name' => $user->name,
        'email' => 'user',
        'role' => $user->role->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertSessionHasErrors('email');
});

test('edit email is too long', function () {
    $user = User::factory()->create();

    $data = [
        'name' => $user->name,
        'email' => str_repeat('a', 256),
        'role' => $user->role->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertSessionHasErrors('email');
});

test('edit email is unique', function () {
    $user = User::factory()->create();
    $user2 = User::factory()->create();

    $data = [
        'name' => $user->name,
        'email' => $user2->email,
        'role' => $user->role->value,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertSessionHasErrors('email');
});

test('edit role is required', function () {
    $user = User::factory()->create();

    $data = [
        'name' => $user->name,
        'email' => $user->email,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertSessionHasErrors('role');
});

test('can edit a user', function () {
    $user = User::factory()->create();

    $this->get(route('users.edit', $user->id))
        ->assertStatus(200)
        ->assertSee($user->name)
        ->assertSee($user->email)
        ->assertSee($user->role->name);
});

test('can update a user', function () {
    $user = User::factory()->create();

    $data = [
        'name' => 'Test Edit name',
        'email' => 'edit@test.com',
        'role' => RoleEnum::User->value,
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123',
    ];

    $this->put(route('users.update', $user->id), $data)
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'email' => 'edit@test.com',
        'name' => 'Test Edit name',
    ]);
});

// checar validações

test('can delete a user', function () {
    $user = User::factory()->create();

    $this->delete(route('users.destroy', $user->id))
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('users', [
        'id' => $user->id,
    ]);
});
