<?php
  
  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  
  class ProductController extends Controller
  {
      public function product()
      { 
          return view('product'); // Halaman home yang dapat diakses tanpa login
      }
  }
  