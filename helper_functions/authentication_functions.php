<?php
function signUp($email, $password)
{
    //insert the user into the database
    global $con;
    $encrypted_password=password_hash($password, PASSWORD_DEFAULT);
    $insert_user = "INSERT INTO users (email, password) VALUES ('$email', '$encrypted_password')";
    $result = mysqli_query($con, $insert_user);
    if ($result) {
        echo json_encode(
            [
                'success' => true,
                'message' => 'User created successfully'
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'User creation failed'
            ]
        );
    }
}
function login($password, $databasePassword, $userID)
{
    //insert the user into the database
    
    if(password_verify($password, $databasePassword)){
      //login the user
      //create personal accress token
      $token =bin2hex(openssl_random_pseudo_bytes(16));

      global $con;
      $insert_token="INSERT INTO personal_access_token(user_id,token)VALUES('$userID','$token')";
      
      $result = mysqli_query($con, $insert_token);
        if ($result) {
            echo json_encode(
                [
                    'success' => true,
                    'message' => 'User logged in successfully',
                    'token' => $token
                ]
            );
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'User login failed'
                ]
            );
        }
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Password is incorrect'
            ]
        );
    }
}
    