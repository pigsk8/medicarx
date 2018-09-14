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
        $user_state2 = new \App\EstadoUsuario();
        $user_state2->descripcion = 'activo';
        $user_state2->save();    

        $user_state3 = new \App\EstadoUsuario();
        $user_state3->descripcion = 'inactivo';
        $user_state3->save();  
        
        $c_state = new \App\EstadoConsulta();
        $c_state->descripcion = 'pendiente';
        $c_state->save();    
        
        $c_state2 = new \App\EstadoConsulta();
        $c_state2->descripcion = 'revisada';
        $c_state2->save(); 

        //ENTRUST ADMIN

        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->display_name = 'Administrator'; // optional
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
            'username' => 'admin',
            'ci' => '111111',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'avatar' => '',
            'estado_usuario_id' => 1
            ]);
        //$adminUser->save();
        $adminUser->attachRole($admin);

        $pacienteUser = \App\User::create([
            'name' => 'paciente',
            'username' => 'paciente',
            'ci' => '222222',
            'email' => 'paciente@mail.com',
            'password' => bcrypt('paciente'),
            'avatar' => '',
            'estado_usuario_id' => 1
            ]);
        $pacienteUser->attachRole($paciente);

        $medicoUser = \App\User::create([
            'name' => 'medico',
            'username' => 'medico',
            'ci' => '3333333',
            'email' => 'medicon@mail.com',
            'password' => bcrypt('medico'),
            'avatar' => '',
            'estado_usuario_id' => 1
            ]);
        $medicoUser->attachRole($medico);
        
    }
}
