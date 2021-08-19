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
    async function hide(event) {
        let id = event.target.dataset.id;
        let response = await fetch('ajax.php?action=hide&id=' + id);
        if (response.ok) {
            let result = await response.json();
            if (result) {
                event.target.parentElement.parentElement.remove();
            } else {
                alert("Ошибка");
            }
        } else {
            alert(response.status);
        }
    }

    async function plusQuantity(event) {
        let id = event.target.dataset.id;
        let response = await fetch('ajax.php?action=quantity&option=plus&id=' + id);
        if (response.ok) {
            let result = await response.json();
            if (result) {
                event.target.parentElement.querySelector('span').innerText = parseInt(event.target.parentElement.querySelector('span').innerText) + 1;
            } else {
                alert("Ошибка");
            }
        } else {
            alert(response.status);
        }
    }

    async function minusQuantity(event) {
        let id = event.target.dataset.id;
        let response = await fetch('ajax.php?action=quantity&option=minus&id=' + id);
        if (response.ok) {
            let result = await response.json();
            if (result) {
                event.target.parentElement.querySelector('span').innerText = parseInt(event.target.parentElement.querySelector('span').innerText) - 1;
            } else {
                alert("Ошибка");
            }
        } else {
            alert(response.status);
        }
    }

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
                    let span = document.createElement('span');
                    span.innerText = products[i][j];
                    td.appendChild(span);
                    if (j === "PRODUCT_QUANTITY") {
                        let button = document.createElement('button');
                        button.innerText = "+";
                        button.setAttribute('data-id', products[i]["PRODUCT_ID"]);
                        button.addEventListener('click', plusQuantity);
                        td.appendChild(button);
                        button = document.createElement('button');
                        button.innerText = "-";
                        button.setAttribute('data-id', products[i]["PRODUCT_ID"]);
                        button.addEventListener('click', minusQuantity);
                        td.appendChild(button);
                    }
                    tr.appendChild(td);
                }
                let td = document.createElement('td');
                let button = document.createElement('button');
                button.innerText = "Скрыть";
                button.setAttribute('data-id', products[i]["PRODUCT_ID"]);
                button.addEventListener('click', hide);
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