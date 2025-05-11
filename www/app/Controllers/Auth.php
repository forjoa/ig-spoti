<?php namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller {
    public function signUp() {
        if (session()->get('isLoggedIn')) return redirect()->to('/home');

        helper(['form']);
        echo view('layout', [
            'title' => 'Sign Up',
            'content' => view('auth/signup')
        ]);
    }

    public function handleSignUp() {
        $model = new UserModel();
        $validation = \Config\Services::validation();
    
        // Reglas de validación
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).+$/]',
            'repeat_password' => 'matches[password]'
        ];
    
        // Validar datos
        if (!$this->validate($rules)) {
            return redirect()->to('/sign-up')
                ->withInput() // Conserva los datos del formulario
                ->with('errors', $validation->getErrors()); // Envía errores a la vista
        }
    
        try {
            $model->save([
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'username' => $this->request->getPost('username') ?? explode('@', $this->request->getPost('email'))[0]
            ]);
        
            return redirect()->to('/sign-in')->with('success', '¡Registro exitoso!');
        
        } catch (\Exception $e) {
            log_message('error', 'Error al registrar usuario: ' . $e->getMessage());
            return redirect()->to('/sign-up')->withInput()->with('error', 'Ocurrió un error al registrar el usuario.');
        }
    }

    public function signIn() {
        if (session()->get('isLoggedIn')) return redirect()->to('/home');

        echo view('layout', [
            'title' => 'Sign In',
            'content' => view('auth/signin')
        ]);
    }

    public function handleSignIn() {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials');
        }

        session()->set([
            'isLoggedIn' => true,
            'user_id' => $user['id'],
            'user_email' => $user['email']
        ]);
        return redirect()->to('/home');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/');
    }
}