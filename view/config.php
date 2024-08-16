<?php

$conn = mysqli_connect("localhost", "root", "", "ql_shophoa");

if (!$conn) {
    echo "Connection Failed";
}