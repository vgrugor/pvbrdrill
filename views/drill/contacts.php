<?php require ROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center">Контакти</h1>
        <br/>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Бурова</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">email</th>
                    <th scope="col">Адреса</th>
                </tr>
            </thead>
            <tbody class="table-striped">
                <?php foreach ($contactsList as $contactsItem): ?>
                    <tr>
                        <td><a href="drill/<?=$contactsItem['id']?>"> <?=$contactsItem['drill']?></a></td>
                        <td><?=$contactsItem['phone_number']?></td>
                        <td><a href="mailto:<?=$contactsItem['email']?>"><?=$contactsItem['email']?></a></td>
                        <td><?=$contactsItem['address']?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require ROOT . '/views/layouts/footer.php'; ?>