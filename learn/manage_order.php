<?php
session_start();


if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['Add_to_order']))
    {
        if(isset($_SESSION['order']))
        {
            $myitems= array_column($_SESSION['order'],'Item_name');
            if(in_array($_POST['Item_name'],$myitems))
            {
                echo"<script>
                alert('Item already added');
                window.location.href='index.php';
                </script>";
            }
            else{
                $count= count($_SESSION['order']);
                $_SESSION['order'][$count] = array('Item_name'=>$_POST['Item_name'],'price'=>$_POST['price'],'Quantity'=>1);
                echo"<script>
                alert('Item added');
                window.location.href='index.php';
                </script>";
            }
        }
        else
        {
            $_SESSION['order'][0]=array('Item_name'=>$_POST['Item_name'],'price'=>$_POST['price'],'Quantity'=>1);
            echo"<script>
            alert('Item added');
            window.location.href='index.php';
            </script>";
        }
    }
    if (isset($_POST['Remove_Item']))
    {
        foreach($_SESSION['order'] as $key=> $value)
        {
            if($value['Item_name']==$_POST['Item_name'])
            {
                unset($_SESSION['order'][$key]);
                $_SESSION['order']=array_values($_SESSION['order']);
                echo"<script>
                alert('Item Removed');
                window.location.href='myorders.php';
                </script>";
            }

        }
    }
    if(isset($_POST['Mod_Quantity']))
    {
        foreach($_SESSION['order'] as $key=> $value)
        {
            if($value['Item_name']==$_POST['Item_name'])
            {
                $_SESSION['order'][$key]['Quantity']=$_POST['Mod_Quantity'];
                
                echo"<script>
                window.location.href='myorders.php';
                </script>";
            }

        }
    }
}


?>