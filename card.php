<?php
session_start();

require_once 'products.php';
require_once 'functions.php';

if ($_GET['action'] === 'add') {
    
    makeAnArray();
     $ids = array_keys($_SESSION['cart']['products']);
   addProduct($ids);
};


if ($_GET['action'] === 'list') {
 $cardItems = makeList($products);
 $total_sum = totalSum($cardItems);
 require_once 'views/card.view.php';
};

if (isset($_POST['btn'])) {
    saveChanges();
};

if ($_GET['action'] === 'remove'){
    removeItem();
};



if ($_GET['action'] === 'clean') {
   cleanUp();

};
