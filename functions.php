<?php
//require_once 'products.php';
function makeAnArray(){
    if (!isset($_SESSION['cart'])) {
     $_SESSION['cart'] = [
            'products' => [
                //'100' => '3'
            ],
        ];
       
    };
  
};


function addProduct($a){
    if (in_array($_GET['product_id'], $a)) {
        $_SESSION['cart']['products'][$_GET['product_id']]++;
    } else {
        $_SESSION['cart']['products'][$_GET['product_id']] = 1;
    }
   
    header('Location: card.php?action=list');
};


function makeList($products){
    $cardItems = [];
    if (count ($_SESSION['cart']['products']) > 0) {
        foreach($_SESSION['cart']['products'] as $product_id => $qty) {
           
            $cardItems[] = (object)[
                'id' => $product_id,
                'qty' => $qty,
                'info' => (object)$products[$product_id],
            ];
        }
    };
    return $cardItems;
};


function saveChanges(){
    
        $update = array_combine(
            $_POST['qty']['id'],
            $_POST['qty']['qty']
        );
      foreach($update as $id => $qty ){
          $_SESSION['cart']['products'][$id] = $qty;
      };
      header('Location: card.php?action=list');
    
};


function totalSum($cardItems){
    $total_sum = 0;
    for($i=0; $i<count($cardItems); $i++){
        $cost=$cardItems[$i]->qty*$cardItems[$i]->info->price;
        $total_sum += $cost;
    };
    return $total_sum;
}

function removeItem(){
        unset($_SESSION['cart']['products'][$_GET['product_id']]);
        header('Location: card.php?action=list');
    };
 
 function cleanUp(){
       $_SESSION['cart']['products'] = [];
        header('Location: card.php?action=list');
     };