<?php

   use App\Helpers\HashidsHelper;

   if (!function_exists('encode')) {
       function encode($id)
       {
           return HashidsHelper::encode($id);
       }
   }

   if (!function_exists('decode')) {
       function decode($hash)
       {
           return HashidsHelper::decode($hash);
       }
   }