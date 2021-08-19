<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <style>
        table {
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #000;
            height: 20px;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Product Article</th>
        <th>Product Quantity</th>
        <th>Date Create</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<br>

<script>
    async function main() {
        let response = await fetch('ajax.php?action=getProducts');
        if (response.ok) {
            let products = await response.json();
            for (let i in products) {
                delete products[i]["ID"];
                delete products[i]["HIDE"];
                let tr = document.createElement('tr');
                for (let j in products[i]) {
                    let td = document.createElement('td');
                    td.innerText = products[i][j];
                    tr.appendChild(td);
                }
                let td = document.createElement('td');
                let button = document.createElement('button');
                button.innerText = "Скрыть";
                button.setAttribute('id', 'hide');
                button.setAttribute('data-id', products[i]["PRODUCT_ID"]);
                td.appendChild(button);
                tr.appendChild(td);
                let tbody = document.querySelector('tbody');
                tbody.appendChild(tr);
            }
        } else {
            alert(response.status);
        }
    }

    document.addEventListener("DOMContentLoaded", main);
</script>
</body>
</html>