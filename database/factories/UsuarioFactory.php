<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'estado' => 1,
            'tipo_usuario_id' => $this->faker->randomElement(\App\Models\TipoUsuario::pluck('id')->toArray()),
            'registrado_por' => $this->faker->name(),
        ];
    }
}