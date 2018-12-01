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
        //estados
        $user_state = new \App\EstadoUsuario();
        $user_state->descripcion = 'activo';
        $user_state->save();    

        $user_state2 = new \App\EstadoUsuario();
        $user_state2->descripcion = 'inactivo';
        $user_state2->save();  
        
        $c_state = new \App\EstadoConsulta();
        $c_state->descripcion = 'pendiente';
        $c_state->save();    
        
        $c_state2 = new \App\EstadoConsulta();
        $c_state2->descripcion = 'revisada';
        $c_state2->save();

        $c_state = new \App\Estudio();
        $c_state->descripcion = 'torax';
        $c_state->save();

        $c_state2 = new \App\Estudio();
        $c_state2->descripcion = 'craneo';
        $c_state2->save(); 

        //preguntas
        $preg1 = new \App\Pregunta();
        $preg1->descripcion = '¿país favorito?';
        $preg1->save();
        $preg2 = new \App\Pregunta();
        $preg2->descripcion = '¿animal favorito?';
        $preg2->save();
        $preg3 = new \App\Pregunta();
        $preg3->descripcion = '¿carro favorito?';
        $preg3->save();

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
            'estado_usuario_id' => 1
            ]);
        $adminUser->attachRole($admin);

        $pacienteUser = \App\User::create([
            'name' => 'paciente',
            'username' => 'paciente',
            'ci' => '222222',
            'email' => 'paciente@mail.com',
            'password' => bcrypt('paciente'),
            'estado_usuario_id' => 1
            ]);
        $pacienteUser->attachRole($paciente);

        $medicoUser = \App\User::create([
            'name' => 'medico',
            'username' => 'medico',
            'ci' => '3333333',
            'email' => 'medico@mail.com',
            'password' => bcrypt('medico'),
            'estado_usuario_id' => 1
            ]);
        $medicoUser->attachRole($medico);
        
    }
}
