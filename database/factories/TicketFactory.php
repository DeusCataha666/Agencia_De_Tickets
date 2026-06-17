<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ticket;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'imagen' => $this->faker->optional()->imageUrl(),
            'estado' => 1,
            'registrado_por' => $this->faker->name(),
            'fecha_creacion' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'fecha_cierre' => $this->faker->optional(0.3)->dateTimeBetween('now', '+1 month'),
            'cliente_id' => $this->faker->randomElement(\App\Models\Cliente::pluck('id')->toArray()),
            'usuario_asignado_id' => $this->faker->randomElement(\App\Models\Usuario::pluck('id')->toArray()),
        ];
    }
}