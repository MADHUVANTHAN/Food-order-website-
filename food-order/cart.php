<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Food Order Cart</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
  }

  /* Cart container */
  .cart-container {
    max-width: 600px;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    background-color: #f9f9f9;
  }

  /* Table styling */
  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }

  /* Checkout button */
  .checkout-btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    margin-top: 20px;
  }
</style>
</head>
<body>

<!-- Cart container -->
<div class="cart-container">
  <!-- Cart table -->
  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <!-- Sample cart items (replace with actual items from the backend) -->
      <tr>
        <td>Burger</td>
        <td>1</td>
        <td>$5.99</td>
      </tr>
      <tr>
        <td>Pizza</td>
        <td>2</td>
        <td>$12.50</td>
      </tr>
      <tr>
        <td>Salad</td>
        <td>1</td>
        <td>$7.25</td>
      </tr>
    </tbody>
  </table>
  
  <!-- Checkout button -->
  <a href="#" class="checkout-btn">Proceed to Checkout</a>
</div>

</body>
</html>
