<?php

session_start();


$_SESSION['products']= [
  [
      'id' => 1,
      'category' => 'Clothes',
      'name' => 'Product 1',
      'price' => 1000,
      'created_at' => '2022-05-02'
  ],
  [
      'id' => 2,
      'category' => 'Clothes',
      'name' => 'Product 2',
      'price' => 2000,
      'created_at' => '2022-05-02'
  ],
  [
    'id' => 3,
    'category' => 'Shirts',
    'name' => 'Product 3',
    'price' => 3000,
    'created_at' => '2022-05-02'
  ],
  [
    'id' => 4,
    'category' => 'Clothes',
    'name' => 'Product 4',
    'price' => 4000,
    'created_at' => '2022-05-02'
  ]
];