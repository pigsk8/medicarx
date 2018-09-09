<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user_state = new \App\EstadoUsuario();
        $user_state->descripcion = 'activo';
        $user_state->save();    
        
        $user_state2 = new \App\EstadoUsuario();
        $user_state2->descripcion = 'inactivo';
        $user_state2->save();        

        //ENTRUST ADMIN
        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description = 'User is allowed to manage all resources'; // optional
        $admin->save();
        
        $paciente = new \App\Role();
        $paciente->name = 'paciente';
        $paciente->display_name = 'Paciente'; // optional
        $paciente->description = 'paciente'; // optional
        $paciente->save();

        $medico = new \App\Role();
        $medico->name = 'medico';
        $medico->display_name = 'Medico'; // optional
        $medico->description = 'medico'; // optional
        $medico->save();

        $adminUser = \App\User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('secret')
            ]);
        $adminUser->save();

        $adminUser->attachRole($admin);
    }
}
