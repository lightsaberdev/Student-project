<?php

// CREATE A food.txt file and insert the next line
// a:4:{i:0;a:4:{i:0;i:1;i:1;i:50;i:2;s:25:"Adobong Manok with Drinks";i:3;i:12;}i:1;a:4:{i:0;i:2;i:1;i:70;i:2;s:16:"Inihaw na Bangus";i:3;s:0:"";}i:2;a:4:{i:0;i:3;i:1;i:40;i:2;s:25:"Pinakbet with Double Rice";i:3;i:24;}i:3;a:4:{i:0;s:1:"4";i:1;s:2:"50";i:2;s:25:"Adobong Manok With Drinks";i:3;s:2:"12";}}

// get array on file
$foods = unserialize(file_get_contents("foods.txt"));

//add food
if(isset($_POST['addFood'])) {
    $orderNumber = $_POST['orderNumber'];
    $foodPrice = $_POST['foodPrice'];
    $foodName = $_POST['foodName'];
    $foodAddOns = $_POST['foodAddOns'];

    if(!empty($foodName) || !empty($foodPrice)) {
        $addFood = array($orderNumber, $foodPrice, $foodName, $foodAddOns);
        array_push($foods, $addFood);
        file_put_contents("foods.txt",serialize($foods));
    }
}

// place order
if (isset($_POST['placeOrder'])) {
    $customerName = $_POST['customerName'];
    $customerOrder = $_POST['customerOrder'];

    if($customerOrder == 1) {
        $customerOrder = $foods[0][0];
        $orderPrice = $foods[0][1];
        $foodName = $foods[0][2];
        $adOns = $foods[0][3];
    }
    else if($customerOrder == 2) {
        $customerOrder = $foods[1][0];
        $orderPrice = $foods[1][1];
        $foodName = $foods[1][2];
        $adOns = $foods[1][3];
    }
    else if($customerOrder == 3) {
        $customerOrder = $foods[2][0];
        $orderPrice = $foods[2][1];
        $foodName = $foods[2][2];
        $adOns = $foods[2][3];
    }
}

//remove food from array




$test = count($foods);
?>

<?php for ($i = 0; $i < $test; $i++) {?>
    <p>[<?=$foods[$i][0];?>] [P <?=$foods[$i][1];?>] <?=$foods[$i][2];?> <?php if($foods[$i][3] !== "") {echo '(Plus [P '.$foods[$i][3].'])';} else {echo $foods[$i][3];} ?></p>


<?php }?>
<br>
<style>
    div {
        display: flex;
        justify-content: space-between;
        width: 350px;
        margin: 10px;
    }
</style>
<form method="post">
    <div>
        <label for="">Customer Name</label>
        <input type="text" name="customerName" value="<?=$customerName ?? '';?>">
    </div>
    <div>
        <label for="">Customer Order</label>
        <input type="number" name="customerOrder" value="<?=$customerOrder ?? '';?>">
    </div>
    <div>
        <label for="">Order Price</label>
        <input type="number" value="<?=$orderPrice ?? '';?>" disabled>
    </div>
    <div>
        <label for="">Add-ons Price</label>
        <input type="number" value="<?=$adOns ?? '';?>" disabled>
    </div>
    <div>
        <button type="submit" name="placeOrder">Place Order</button>
    </div>

    <br>
    <br>
    
    <div>
        <input type="hidden" name="orderNumber" value="<?=end($foods)[0] + 1;?>">
        <label for="">Food Name</label>
        <input type="text" name="foodName" >
    </div>
    <div>
        <label for="">Food Price</label>
        <input type="number" name="foodPrice" >
    </div>
    <div>
        <label for="">Add-ons Price</label>
        <input type="number" name="foodAddOns" >
    </div>
    <div>
        <button type="submit" name="addFood">Add Food</button>
    </div>

    <!--<br>
    <br>
    <h1>Remove Food on list</h1>
    <br>
    <div>
        <label for="">Food Number</label>
        <input type="number" name="foodNumber" >
    </div>
    <div>
        <button type="submit" name="test">Remove</button>
    </div>

    --><?php /*echo $foods[1][0];*/?>
</form>
