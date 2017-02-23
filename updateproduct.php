<?php

session_start();
$itemId = isset($_GET['itemId']) ? $_GET['itemId'] : "";
if ($_POST)
{
    for ($i = 0; $i < count($_POST['quantity']); $i++)
    {
        $key = $_POST['arr_key_' . $i];
        $_SESSION['quantity'][$key] = $_POST['quantity'][$i];
        header('location:order.php');
    }
} else
{
    if (!isset($_SESSION['cart']))
    {
        $_SESSION['cart'] = array();
        $_SESSION['quantity'][] = array();
    }

    if (in_array($itemId, $_SESSION['cart']))
    {
        $key = array_search($itemId, $_SESSION['cart']);
        $_SESSION['quantity'][$key] = $_SESSION['quantity'][$key] + 1;
        header('location:index.php?a=exists');
    } else
    {
        array_push($_SESSION['cart'], $itemId);
        $key = array_search($itemId, $_SESSION['cart']);
        $_SESSION['quantity'][$key] = 1;
        header('location:index.php?a=add');
    }
}