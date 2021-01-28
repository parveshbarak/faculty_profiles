<?php;

namespace Project\Helpers

class Login_Helper {

    public function google_info($google_client) {
        
        $google_client->setClientId('751169053910-382q6g08q97525vt4qp4qmchn8uutrgn.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('oIvz-ebQoZi71e2owuTwWnr0'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/faculty_profiles/index.php/google_login/login'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');
        
        // print_r($google_client); die;
        return $google_client;
    }
    
    private function update_account_status($em,$ci, $id, $unique_key) : void {
        $get_input = $ci->input->get();
        // print_r($get_input); die;
        if($get_input){
           $email = $get_input['email']; 
        //    $account_status = $get_input['account_status']; 
           $user = $em->getRepository('Project\Models\User')->update_library_account_status($em, $id, $unique_key, 'approved');
        }
        
        return;
    }

}
