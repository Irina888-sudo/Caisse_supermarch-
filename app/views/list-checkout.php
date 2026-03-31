<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of cities</title>
    <link rel="stylesheet" href="/assets/css/table.css">
</head>
<body>
    
    <main>
        <h1></h1>

        <section class="checkout-list">
    <?php if(!empty($caisses)) : ?>
        <select>
  <option value="">Sélectionnez un checkout</option>
    <?php foreach($caisses as $checkout) : ?>
        <option value="<?php echo $checkout->getNumber(); ?>"><?php echo $checkout->getNumber(); ?></option>
</select>
</section>

    </main>
  
</body>
</html>