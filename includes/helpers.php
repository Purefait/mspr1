<?php


function connectDB(){
    global $database;

    $host = $database['localhost'];
    $dbname = $database['mspr1'];
    $username = $database['root'];
    $password = $database[''];

    return new PDO("mysql:host=$host;dbname=$dbname", "$username", "$password");

}

function getID($id){

    $bdd = connectDB();

    $query = $bdd->prepare("SELECT *  FROM users WHERE id = $id");

    $query->execute();

}

function getUser(){

    $bdd = connectDB();
    $stmt = $bdd->prepare("SELECT * FROM publications  ORDER BY RAND() LIMIT 5");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function isAuth(){
    return isset($_SESSION['user_id']);
}

function getAuth(){
    if(!isAuth()){
        return false;
    }
    return getUser($_SESSION['user_id']);
}

function getAuthId(){
    $auth = getAuthId();
    return $auth['id'];
}