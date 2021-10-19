<?php

require_once '../../init.php';

if (!Auth::hasRole('seller')) {
    header('Location: /views/403.php');
}

$rules = [
    'name' => 'required',
    'price' => 'required',
];

$errors = [];

if (isset($_POST['submit'])) {

    $image = $_FILES["image"] ? $_FILES['image']['name'] : null;

    $file_tmp = $_FILES['image']['tmp_name'];

    $errors = Form::validate($rules);

    if (count($errors) === 0) {
        $data = [
            'name' => $_POST['name'],
            'price' => (float)$_POST['price'],
            'image' => $image,
            'description' => $_POST['description'],
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => Auth::getUser()->id
        ];

        Database::connect()->table('products')->insert($data);

        move_uploaded_file($file_tmp, __DIR__ . '/../../assets/images/' . $image);

        header("Location:/views/seller/my_products.php");

    }

}

?>

<html lang="en">
<title>
    Add Products
</title>
<link rel="stylesheet" href="../../assets/main.css"/>
<body>
<?php include '../partials/navbar.php' ?>
<div class="container">
    <div class="card">
        <form method="post" action=""
              enctype="multipart/form-data"
        >
            <div class="row">
                <div class="col-6">
                    <p>Product Name*</p>
                    <input type="text" name="name"/>
                    <small class="text-error">
                        <?php echo array_key_exists('name', $errors) ? $errors['name'] : '' ?>
                    </small>
                </div>
                <div class="col-6">
                    <p>Product Price*</p>
                    <input type="text" name="price"/>
                    <small class="text-error">
                        <?php echo array_key_exists('price', $errors) ? $errors['name'] : '' ?>
                    </small>
                </div>
                <div class="col">
                    <input type="file" name="image"/>
                </div>
                <div class="col mt-1">
                    <p>Descriptions</p>
                    <textarea name="description"></textarea>
                </div>

            </div>

            <button class="btn btn-primary" type="submit" name="submit">add products</button>


        </form>
    </div>

</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
