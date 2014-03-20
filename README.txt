C391Proj1
=========

Radiology Web App


Copy the files in C391Proj1 folder into you php folder:

/compsci/webdocs/<userid>/web_docs/

and access with it like:

http://consort.cs.ualberta.ca/~userid/php_file.php


SESSION VARIABLES USED IN PROJECT:
To resume a session you have to declare: 
session_start();
before you can use a session variable.


$_SESSION['person_id']
  This stores the person id of the person currently logged in.
  
$_SESSION['person_class']
  This stores the person class that the user currenly logged in is.
  The classes are:
    a - administrator
    p - patient
    d - doctor
    r - radiologist
