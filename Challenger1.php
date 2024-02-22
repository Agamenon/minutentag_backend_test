<?php
// 1) Please, fully explain this function: document iterations, conditionals, and the function objective as a whole*
/**
 * @param mixed $name
 * @param Array $p - Array of Items
 * @param Array $ext - Array of Export Price Items and Quantity
 */
function($p, $o, $ext) {
    $items = [];
    $sp = false;
    $cd = false;

    // List of Items
    $ext_p = [];

    // Create an Array with every quantity of items
    foreach ($ext as $i => $e) {
      $ext_p[$e['price']['id']] = $e['qty'];
    }

    // Create a List of Products from Items selected
    foreach ($o['items']['data'] as $i => $item) {
      // Array of Products
      $product = [
        'id': $item['id']
      ];

      // If exist items on ext_p then extract quantity and if this its over 1 then set quantity to product otherwise set delete product
      if isset($ext_p[$item['price']['id']]) {
          $qty = $ext_p[$item['price']['id']];
          if ($qty < 1) {
              $product['deleted'] = true;
          } else {
              $product['qty'] = $qty;
          }
          // Remove for new iteration
          unset($ext_p[$item['price']['id']]);
      // Else if not exists ext_p then compare items and list price and if same set $sp
      } else if ($item['price']['id'] == $p['id']) {
          $sp = true;
      // Else product was deleted and set $cd to skip
      } else {
          $product['deleted'] = true;
          $cd = true;
      }
      // add to main list
      $items[] = $product;
    }

    // if $sp equal false then create a new item with product an set quantity to 1; Than mean only was selected 1 item
    if (!$sp) {
      $items[] = [
        'id': $p['id'],
        'qty': 1
      ];
    }

    // extract detail price and quantity only from export price list where quantity over than 1
    foreach ($ext_p as $i => $details) {
      // skip when its below 1
      if ($details['qty'] < 1) {
          continue;
      }

      // Create List
      $items[] = [
        'id': $details['price'],
        'qty': $details['qty']
      ];
    }

    // return final list
    return $items;
?>