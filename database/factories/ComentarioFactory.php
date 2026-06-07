<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comentario;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mensaje' => $this->faker->paragraph(),
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'registrado_por' => $this->faker->name(),
            'estado' => 1,
            'ticket_id' => $this->faker->randomElement(\App\Models\Ticket::pluck('id')->toArray()),
            'usuario_id' => $this->faker->randomElement(\App\Models\Usuario::pluck('id')->toArray()),
        ];
    }
}