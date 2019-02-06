<?php

if(isset($_SESSION['logged_in']) )
{
    echo  "<a href='profile.php'>". $_SESSION['Username'] ." <i class='fa fa-user' aria-hidden='true''></i></a>";
}
else
{
    echo  "<a href=". $i->href .">". $i->nameMenu ."<i class='fa fa-user' aria-hidden='true''></i> </a>";
}