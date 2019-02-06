<?php
class homeController extends controller
{
    private function verifyCaptcha($response)
    {
        $privatekey = "YOUR_PRIVATE_KEY";
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $privatekey,
            'response' => $response,
        );
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $response = json_decode($verify);
        return $response;
/*
{
"success": true|false,
"challenge_ts": timestamp,  // timestamp of the challenge load (ISO format yyyy-MM-dd'T'HH:mm:ssZZ)
"hostname": string,         // the hostname of the site where the reCAPTCHA was solved
"error-codes": [...]        // optional
}
 */
    }

    public function index()
    {
        // echo "<p>".$_SERVER['REQUEST_URI']."</p>";
        // echo "<p>".$_SERVER['HTTP_HOST']."</p>";
        // echo "<p>Get:".print_r($_GET,true)."</p>";
        $this->title("Home");
        if (srv::isPost()) {
            $this->render("home", "index", $_POST);
     
        } else {
            $this->render("home", "index");
        }

    }
}
