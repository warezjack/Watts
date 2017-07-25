<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\KerberosAuthenticated as KerberosAuthenticated;


class SettingsController extends Controller
{
    public function index() {
      $userDetails = KerberosAuthenticated::where('user_id', Auth::user()->id)->first();
      $userAuthenticated = $userDetails['is_authenticated'];
      return View::make('settings')->with(compact('userAuthenticated'));
    }

    public function authenticate(Request $request) {
      $userDetails = KerberosAuthenticated::where('user_id', Auth::user()->id)->first();
      if(isset($userDetails['is_authenticated'])) {
        notify()->flash('You are aready authenticated. Please resume your normal operations.', 'error');
        return redirect()->to('settings');
      }
      $host_name = $request->get('host');
      $realm_name = $request->get('realm');
      $password = $request->get('password');
      $key = "!89@G*&)Q5#O0%/(";

      $client = $host_name . '@' . $realm_name;
      $process = new Process("echo '$password' | kinit '$client' ");

      $process->run();
      $process->wait();

      if ($process->isSuccessful()) {
        $kerberos = new KerberosAuthenticated;
        $kerberos->user_id = Auth::user()->id;
        $kerberos->host_name = $host_name;
        $kerberos->realm_name = $realm_name;
        $kerberos->password = $this->encrypt($password, $key);
        $kerberos->is_authenticated = 1;
        $kerberos->save();

        notify()->flash('User Successfully Authenticated', 'success');
        return redirect()->to('settings');
      }
      notify()->flash('Please check your Kerberos Credentials', 'error');
      return redirect()->to('settings');
    }

    public function encrypt($input, $key) {
      $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
      $input = $this->pkcs5_pad($input, $size);
      $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
      $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
      mcrypt_generic_init($td, $key, $iv);
      $data = mcrypt_generic($td, $input);
      mcrypt_generic_deinit($td);
      mcrypt_module_close($td);
      $data = base64_encode($data);
      return $data;
    }

    private function pkcs5_pad ($text, $blocksize) {
      $pad = $blocksize - (strlen($text) % $blocksize);
      return $text . str_repeat(chr($pad), $pad);
    }
}
