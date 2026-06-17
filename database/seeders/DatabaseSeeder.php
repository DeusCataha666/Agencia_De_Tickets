<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\TipoUsuario;
use App\Models\Usuario;
use App\Models\Ticket;
use App\Models\Comentario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        TipoUsuario::factory(5)->create();

        
        Usuario::factory(10)->create();

        
        Cliente::factory(20)->create();

        
        Ticket::factory(50)->create();

        
        Comentario::factory(100)->create();


         /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
    }
}

       

    

