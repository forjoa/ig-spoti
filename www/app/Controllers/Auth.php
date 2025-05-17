<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function signUp()
    {
        if (session()->get('isLoggedIn'))
            return redirect()->to('/home');

        helper(['form']);
        echo view('auth/signup');
    }

    public function handleSignUp()
    {
        $validation = \Config\Services::validation();

        // Reglas de validación
        $rules = [
            'email' => [
                'label' => 'Correo electrónico',
                'rules' => 'required|valid_email|is_unique[users.email]|validateEmailDomain',
                'errors' => [
                    'required' => 'El correo electrónico es obligatorio.',
                    'valid_email' => 'La dirección de correo electrónico no es válida.',
                    'is_unique' => 'La dirección de correo electrónico ya está registrada.',
                    'validateEmailDomain' => 'Solo se aceptan correos de los dominios @students.salle.url.edu, @ext.salle.url.edu o @salle.url.edu.',
                ],
            ],
            'password' => [
                'label' => 'Contraseña',
                'rules' => 'required|min_length[8]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).+$/]',
                'errors' => [
                    'required' => 'La contraseña es obligatoria.',
                    'min_length' => 'La contraseña debe contener al menos 8 caracteres.',
                    'regex_match' => 'La contraseña debe contener letras mayúsculas, minúsculas y números.',
                ],
            ],
            'repeat_password' => [
                'label' => 'Repetir contraseña',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Debe repetir la contraseña.',
                    'matches' => 'Las contraseñas no coinciden.',
                ],
            ],
        ];

        // Validar datos
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validación incorrecta.');
        }

        // Procesar datos
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $username = $this->request->getPost('username') ?? explode('@', $email)[0];
        $profile_picture = $this->request->getPost('profile_picture') ?? 'default.png';

        $password_hashed = password_hash(trim($password), PASSWORD_DEFAULT, ['cost' => 10]);

        $model = new UserModel();

        try {
            $model->save([
                'email' => $email,
                'password' => $password_hashed,
                'username' => $username,
                'profile_picture' => $profile_picture,
            ]);

            return redirect()->to('/sign-in')->with('success', '¡Registro exitoso!');
        } catch (\Exception $e) {
            log_message('error', 'Error al registrar usuario: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al registrar el usuario.');
        }
    }



    public function signIn()
    {
        if (session()->get('isLoggedIn'))
            return redirect()->to('/home');

        echo view('auth/signin');
    }

    public function handleSignIn()
    {
        $model = new UserModel();
        $email = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        $user = $model->where('email', $email)->first();


        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Credenciales inválidas');
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id' => $user['id'],
            'user_email' => $user['email']
        ]);
        return redirect()->to('/home');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}