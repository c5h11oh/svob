<?php
   set_exception_handler(
       function (Throwable $ex ){
           print "Error: ". $ex->getMessage() . ".\n";
           die();
       }
    );