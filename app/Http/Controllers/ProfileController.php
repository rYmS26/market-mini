<?php
  
  namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  
  class ProfileController extends Controller
  {
      public function profile()
      { 
          return view('profile'); // Halaman home yang dapat diakses tanpa login
      }
  }
  